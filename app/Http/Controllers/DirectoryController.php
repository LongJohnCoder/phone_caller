<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Http\Requests;
use App\Model\Directories;
use App\Model\BusinessListing;
use App\Model\CallStack;
use File;
use View;
use Illuminate\Routing\UrlGenerator;
use Aloha\Twilio\Twilio;
use Services_Twilio;
use Aloha\Twilio\TwilioInterface;
use Services_Twilio_Twiml;
class DirectoryController extends Controller
{
    //
    public function Add(){
    	$direct=$this->direc;
    	return view('directory.add',compact('direct'));
    }
    public function Save(Request $request){
    	//$direct=$this->direc;
    	$Directories=new Directories;
    	$Directories->name=$request->input('directory_name');
    	$Directories->description=$request->input('directory_desc');
    	$Directories->save();
    	return redirect('directory/list');

    }
    public function ListsDirect(){
    	$direct=$this->direc;
    	$Directories=Directories::all();
    	return view('directory.list',compact('Directories','direct'));
    	//dd($Directories);
    }
    public function BuisnessList($directory){
    	$direct=$this->direc;
        $directory;
        $BusinessListing=BusinessListing::where('type',$directory)->get();
    	return view('directory.buisness_list',compact('direct','directory','BusinessListing'));
    }
    public function UploadXml($directory){
    	$direct=$this->direc;
    	return view('directory.uploadxml',compact('direct','directory'));
    }
    public function saveXml(Request $request){
    	$avatar =$request->file('directory_file');
		$filename_avatar = $avatar->getClientOriginalName();
		
		$filename_avatar = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename_avatar);
        
        $extension = $avatar->getClientOriginalExtension(); 
    	//dd($request->all());
        if($extension=='php' || $extension=='html' || $extension=='js' || $extension=='css'|| $extension=='sh')
        {
            return Redirect::back()->with('error','this extension is not alowed to upload.')->withInput();
        }
        else
        {
            $destinationPath = 'uploads/buisness/';
            $newfilename = rand(1000, 9999)."-".date('U').'.'.$extension;
            $uploadSuccess = $avatar->move($destinationPath, $newfilename);
            $typ=$request->input('type');
            $exc= $this->readNstore($typ,$newfilename);
            
        }
    }
    public function readNstore($typ,$newfilename){
        $destinationPath = 'uploads/buisness/'.$newfilename;
        $data = Excel::load( $destinationPath, function($reader) {
            })->get();
        foreach ($data as  $value) {
            $BusinessListing=new BusinessListing;
            $BusinessListing->type=$typ;
            $BusinessListing->company_name=$value->name_of_the_company;
            $BusinessListing->website=$value->website;
            $BusinessListing->address=$value->address;
            $BusinessListing->phone=$value->phone;
            $BusinessListing->email_id=$value->email_id;
            $BusinessListing->called=0;
            $BusinessListing->subscribed=0;
            $BusinessListing->save();
        }
            
    }
    public function callList($direct,Request $request){
        
        $BusinessListing=BusinessListing::where('type',$direct)->where('phone','!=',"")->first();
        //dd($BusinessListing);
        return \Response::view('Twilio.generate', compact('BusinessListing'))->header('Content-Type', 'text/xml');
        //dd($BusinessListing);
        
    }
    public function readNCall(){
            $fpath=url('/')."/directory/calllist/2";
            //dd($fpath);
            $sid = env('TWILLIO_LIVE_SID');
            $token = env('TWILLIO_LIVE_TOKEN');
            $number = env('TWILIO_LIVE_NUNBER');
            $client = new Services_Twilio($sid, $token);
            $call = $client->account->calls->create(
            $number,
            '+18127224722', 
            $fpath
            );
        
    }
}
