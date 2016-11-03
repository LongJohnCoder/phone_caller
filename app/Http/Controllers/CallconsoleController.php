<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\BusinessListMapDirectory;
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
            $text_cont=$request->input('text_cont');
            $exc= $this->generateXml($typ,$newfilename,$text_cont);
            return Redirect('start-calling/'.$typ);
        }
	}
	public function generateXml($typ,$newfilename,$text_cont){
		
		$fpath=url('/')."/audio/".$newfilename;
		$BusinessListing=BusinessListing::where('type',$typ)->where('phone','!=',"")->where('called',0)->get();
		
		foreach ($BusinessListing as $key => $value) {
			$fs = new Filesystem();
			$data = array();
			$newfilename = "phonexml/".rand(1000, 9999)."-".date('U').'.xml';
			$location=url('/')."/api/phone/check-confirmation/".$value->id;
			$fs->put($newfilename, \View::make('Twilio.generate', compact('value','fpath','location','text_cont')));
			
			$CallStack=new CallStack;
			$CallStack->pathxl=url('/')."/".$newfilename;
			$CallStack->phone=$value->phone;
			$CallStack->audiofile=$fpath;
			$CallStack->text_cont=$text_cont;
			$CallStack->directory_type=$typ;
			$CallStack->buisness_listing_id=$value->id;
			$CallStack->save();
		}

	}
	public function CheckConfirm($buisness_listin_id,$directory_id,Request $request){
			
		
		if ($request->has('Digits')) {
			$Digits=$request->get('Digits');
			if($Digits==0){

				$BusinessListMapDirectory=BusinessListMapDirectory::where('business_list_id',$buisness_listin_id)->where('directory_id',$directory_id)->first();
				$BusinessListMapDirectory->called=1;
				$BusinessListMapDirectory->subscribed=2;
				$BusinessListMapDirectory->save();

			}
			elseif($Digits==1){
				$tx=time();
				$tmy=date("H:i:s",$tx);
				$BusinessListMapDirectory=BusinessListMapDirectory::where('business_list_id',$buisness_listin_id)->where('directory_id',$directory_id)->first();
				$BusinessListMapDirectory->called=1;
				$BusinessListMapDirectory->subscribed=1;
				$BusinessListMapDirectory->call_time=$tmy;
				$BusinessListMapDirectory->call_now=1;
				$BusinessListMapDirectory->save();

			}
			else{
				$BusinessListMapDirectory=BusinessListMapDirectory::where('business_list_id',$buisness_listin_id)->where('directory_id',$directory_id)->first();
				$BusinessListMapDirectory->called=1;
				$BusinessListMapDirectory->subscribed=1;
				$BusinessListMapDirectory->call_time=$Digits*100;
				$BusinessListMapDirectory->call_now=0;
				$BusinessListMapDirectory->save();
			}

        
        }
		
		
		$content = \View::make('Twilio.confirm_generate');

		return Response::make($content, '200')->header('Content-Type', 'text/xml');
	}
}
