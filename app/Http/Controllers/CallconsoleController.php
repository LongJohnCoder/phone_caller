<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Directories;
use App\Model\BusinessListing;
use App\Model\CallStack;
use DOMDocument;
use Illuminate\Routing\UrlGenerator;
use Aloha\Twilio\Twilio;
use Services_Twilio;
use Aloha\Twilio\TwilioInterface;
use Services_Twilio_Twiml;
use Illuminate\Filesystem\Filesystem;
class CallconsoleController extends Controller
{
    //
    public function addcall(){
		$direct=$this->direc;
    	return view('callstack.add',compact('direct'));

	}
	public function saveexces(Request $request){
		
		$avatar =$request->file('audio');
		$filename_avatar = $avatar->getClientOriginalName();
		
		$filename_avatar = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename_avatar);
        
        $extension = $avatar->getClientOriginalExtension(); 
    	
        if($extension=='php' || $extension=='html' || $extension=='js' || $extension=='css'|| $extension=='sh')
        {
            return Redirect::back()->with('error','this extension is not alowed to upload.')->withInput();
        }
        else
        {
            $destinationPath = 'audio/';
            $newfilename = rand(1000, 9999)."-".date('U').'.'.$extension;
            $uploadSuccess = $avatar->move($destinationPath, $newfilename);
            $typ=$request->input('optionsRadios');
            $exc= $this->generateXml($typ,$newfilename);
            return Redirect('start-calling/'.$typ);
        }
	}
	public function generateXml($typ,$newfilename){
		
		$fpath=url('/')."/audio/".$newfilename;
		$BusinessListing=BusinessListing::where('type',$typ)->where('phone','!=',"")->where('called',0)->get();
		
		foreach ($BusinessListing as $key => $value) {
			$fs = new Filesystem();
			$data = array();
			$newfilename = "phonexml/".rand(1000, 9999)."-".date('U').'.xml';
			$location=url('/')."/api/phone/check-confirmation/".$value->id;
			$fs->put($newfilename, \View::make('Twilio.generate', compact('value','fpath','location')));
			$CallStack=new CallStack;
			$CallStack->pathxl=url('/')."/".$newfilename;
			$CallStack->phone=$value->phone;
			$CallStack->audiofile=$fpath;
			$CallStack->directory_type=$typ;
			$CallStack->buisness_listing_id=$value->id;
			$CallStack->save();
		}

	}
	public function CheckConfirm($buisness_listin_id,Request $request){
			
		$CallStack=CallStack::where('buisness_listing_id',$buisness_listin_id)->first();
		$CallStack->called=$request->input('Digits');
		$CallStack->save();
		if ($request->has('Digits')) {
            $digits = $request->get('Digits');
            $newfilename = "phonexml/".rand(100, 999)."-".date('U').'.xml';	
			$CallStack=CallStack::where('buisness_listing_id',$buisness_listin_id)->first();
			$CallStack->called=$request->get('Digits');
			$CallStack->save();
            $fs = new Filesystem();		
			$fs->put($newfilename, \View::make('Twilio.confirm_generate', compact('digits')));
        	 $sid = env('TWILLIO_LIVE_SID');
            $token = env('TWILLIO_LIVE_TOKEN');
            $number = env('TWILIO_LIVE_NUNBER');
            $pat=url('/')."/".$newfilename;
            
                
            $client = new Services_Twilio($sid, $token);
            $call = $client->account->calls->create(
            $number,
            '+'.$CallStack->phone, 
            $pat
            );

        }
	}
}
