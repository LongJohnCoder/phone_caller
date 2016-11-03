<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Directories;
use App\Model\AudioList;
use App\Model\TextList;
use App\Model\AudioTextDirectoryCallMap;
use App\Model\BusinessListMapDirectory;
use App\Model\CallQueue;
use App\Model\BusinessListing;
use Illuminate\Filesystem\Filesystem;
use Aloha\Twilio\Twilio;
use Services_Twilio;
use Aloha\Twilio\TwilioInterface;
use Services_Twilio_Twiml;
use View;

class ApiCallConsoleController extends Controller
{
    //
    public function saveAndCall(Request $request){
    	
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
            $direct=$request->input('direct');
            //echo $newfilename;
            $fpath=url('/')."/audio/".$newfilename;

            $AudioList=new AudioList;
            $AudioList->audiofile=$fpath;
            $AudioList->name=$filename_avatar;
            $AudioList->save();
            $TextList=new TextList;
            $TextList->text=$text_cont;
            $TextList->save();
            $AudioTextDirectoryCallMapcount=AudioTextDirectoryCallMap::where('directory_id',$direct)->count();
            $AudioTextDirectoryCallMap=new AudioTextDirectoryCallMap;
            $AudioTextDirectoryCallMap->audio_id=$AudioList->id;
            $AudioTextDirectoryCallMap->text_id=$TextList->id;
            $AudioTextDirectoryCallMap->directory_id=$direct;
            $AudioTextDirectoryCallMap->call=$AudioTextDirectoryCallMapcount+1;
            $AudioTextDirectoryCallMap->save();
            $list_id=$request->input('list_id');
            $explistid=explode(",",$list_id);
            foreach($explistid as $val){
            	$BusinessListing=BusinessListing::find($val);
            	$string = str_replace(' ', '', $BusinessListing->phone);
            	$string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
				$string_final =preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
				$fs = new Filesystem();
				$newfilenamexx = "phonexml/".rand(1000, 9999)."-".date('U').'.xml';
				$location=url('/')."/api/phone/check-confirmation/".$BusinessListing->id."/".$direct;
				$fs->put($newfilenamexx, \View::make('Twilio.generate', compact('BusinessListing','fpath','location','text_cont')));
				$CallQueue=new CallQueue;
            	$CallQueue->pathxl=url('/')."/".$newfilenamexx;
				$CallQueue->phone=$string_final;
				$CallQueue->usable_id=$AudioTextDirectoryCallMap->id;
				$CallQueue->called=0;
				$CallQueue->directory_type=$direct;
				$CallQueue->buisness_listing_id=$BusinessListing->id;
				$CallQueue->save();
            }
            $exc = $this->readNCall($direct,$AudioTextDirectoryCallMap->id);
           return Redirect('directory/'.$direct);

        }
        
    }
    public function readNCall($direct,$usable_id){
        
        $CallQueue=CallQueue::where('directory_type',$direct)->where('called','=',0)->where('usable_id',$usable_id)->get();
        
            $sid = env('TWILLIO_LIVE_SID');
            $token = env('TWILLIO_LIVE_TOKEN');
            $number = env('TWILIO_LIVE_NUNBER');
            foreach ($CallQueue as $key => $callx) {
                
            $client = new Services_Twilio($sid, $token);
            $call = $client->account->calls->create(
            $number,
            '+'.$callx->phone, 
            $callx->pathxl
            );
            $BusinessListMapDirectory=BusinessListMapDirectory::where('business_list_id',$callx->buisness_listing_id)->where('directory_id',$callx->directory_type)->first();
            $BusinessListMapDirectory->call_at=date('Y-m-d H:i:s');
            $BusinessListMapDirectory->save();
            $CallQueueup=CallQueue::find($callx->id);
            $CallQueueup->called=1;
            $CallQueueup->save();
            }

            
        
    }
    public function saveAndCallWithAudio(Request $request){
            $typ=$request->input('optionsRadios');
            $text_cont=$request->input('text_cont');
            $direct=$request->input('direct');
            $audio=$request->input('audio');
            $AudioList=AudioList::find($audio);
            $fpath=$AudioList->audiofile;
            $TextList=new TextList;
            $TextList->text=$text_cont;
            $TextList->save();
            $AudioTextDirectoryCallMapcount=AudioTextDirectoryCallMap::where('directory_id',$direct)->count();
            $AudioTextDirectoryCallMap=new AudioTextDirectoryCallMap;
            $AudioTextDirectoryCallMap->audio_id=$audio;
            $AudioTextDirectoryCallMap->text_id=$TextList->id;
            $AudioTextDirectoryCallMap->directory_id=$direct;
            $AudioTextDirectoryCallMap->call=$AudioTextDirectoryCallMapcount+1;
            $AudioTextDirectoryCallMap->save();
            $list_id=$request->input('list_id');
            $explistid=explode(",",$list_id);
            foreach($explistid as $val){
                $BusinessListing=BusinessListing::find($val);
                $string = str_replace(' ', '', $BusinessListing->phone);
                $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
                $string_final =preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                $fs = new Filesystem();
                $newfilenamexx = "phonexml/".rand(1000, 9999)."-".date('U').'.xml';
                $location=url('/')."/api/phone/check-confirmation/".$BusinessListing->id."/".$direct;
                $fs->put($newfilenamexx, \View::make('Twilio.generate', compact('BusinessListing','fpath','location','text_cont')));
                $CallQueue=new CallQueue;
                $CallQueue->pathxl=url('/')."/".$newfilenamexx;
                $CallQueue->phone=$string_final;
                $CallQueue->usable_id=$AudioTextDirectoryCallMap->id;
                $CallQueue->called=0;
                $CallQueue->directory_type=$direct;
                $CallQueue->buisness_listing_id=$BusinessListing->id;
                $CallQueue->save();
            }
            $exc = $this->readNCall($direct,$AudioTextDirectoryCallMap->id);
           return Redirect('directory/'.$direct);
    }
}
