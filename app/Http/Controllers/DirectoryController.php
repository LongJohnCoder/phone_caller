<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Http\Requests;
use App\Model\Directories;
use App\Model\BusinessListing;
use App\Model\CallStack;
use App\Model\BusinessListMapDirectory;
use App\Model\AudioTextDirectoryCallMap;
use App\Model\CallQueue;
use File;
use View;
use Illuminate\Routing\UrlGenerator;
use Aloha\Twilio\Twilio;
use Services_Twilio;
use Aloha\Twilio\TwilioInterface;
use Services_Twilio_Twiml;
use Illuminate\Filesystem\Filesystem;
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
        $BusinessListMapDirectory=BusinessListMapDirectory::where('directory_id',$directory)->with('buisness_details')->get();
        $AudioTextDirectoryCallMap=AudioTextDirectoryCallMap::where('directory_id',$directory)->with('audio','text')->get();
        
        foreach ($BusinessListMapDirectory as $key => $value) {
            $BusinessListMapDirectory[$key]['callno']=CallQueue::where('directory_type',$directory)->where('buisness_listing_id',$value->business_list_id)->count();
        }
        //dd($BusinessListMapDirectory);
        return view('directory.buisness_list',compact('direct','directory','BusinessListMapDirectory','AudioTextDirectoryCallMap'));
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
            return \Redirect::back()->with('success','All Business have been listed Successfuly')->withInput();
            
        }
    }
    public function readNstore($typ,$newfilename){
        $destinationPath = 'uploads/buisness/'.$newfilename;
        $data = Excel::load( $destinationPath, function($reader) {
            })->get();
        foreach ($data as  $value) {

            $BusinessListing=new BusinessListing;
            $BusinessListing->company_name=$value->name_of_the_company;
            $BusinessListing->website=$value->website;
            $BusinessListing->address=$value->address;
            $BusinessListing->phone=$value->phone;
            $BusinessListing->email_id=$value->email_id;
            $BusinessListing->called=0;
            $BusinessListing->subscribed=0;
            $BusinessListing->save();

            $BusinessListMapDirectory=new BusinessListMapDirectory;
            $BusinessListMapDirectory->business_list_id=$BusinessListing->id;
            $BusinessListMapDirectory->directory_id=$typ;
            $BusinessListMapDirectory->save();
        }

            
    }
    public function callList($direct,Request $request){
        
        $BusinessListing=BusinessListing::where('type',$direct)->where('phone','!=',"")->first();
        //dd($BusinessListing);


        $fs = new Filesystem();

        $data = array();

        $fs->put("exercise.xml", View::make('Twilio.generate', compact('BusinessListing')));

        //return \Response::view('Twilio.generate', compact('BusinessListing'))->header('Content-Type', 'text/xml');
        //dd($BusinessListing);
        
    }
    public function readNCall($direct){
        
        $CallStack=CallStack::where('directory_type',$direct)->where('called',Null)->get();
        
            $sid = env('TWILLIO_LIVE_SID');
            $token = env('TWILLIO_LIVE_TOKEN');
            $number = env('TWILIO_LIVE_NUNBER');
            foreach ($CallStack as $key => $call) {
                
            $client = new Services_Twilio($sid, $token);
            $call = $client->account->calls->create(
            $number,
            '+'.$call->phone, 
            $call->pathxl
            );
            
            }

            return \Redirect::back()->with('success','call sequenced in progress')->withInput();
        
    }
    public function AddIndividual($directory){
        $direct=$this->direc;
        $Directories=Directories::where('id',$directory)->first();
        return view('directory.addindividualbuissness',compact('direct','Directories'));

    }
    public function savebusiness(Request $request){
        
        $BusinessListing=new BusinessListing;
        $BusinessListing->company_name=$request->input('company_name');
        $BusinessListing->website=$request->input('website');
        $BusinessListing->address=$request->input('address');
        $BusinessListing->phone=$request->input('phone');
        $BusinessListing->email_id=$request->input('email_id');
        
        $BusinessListing->save();

        $BusinessListMapDirectory=new BusinessListMapDirectory;
        $BusinessListMapDirectory->business_list_id=$BusinessListing->id;
        $BusinessListMapDirectory->directory_id=$request->input('did');
        $BusinessListMapDirectory->save();
        return \Redirect::back()->with('success','call sequenced in progress')->withInput();
    }
    public function editbusiness($buisness_id){
        $direct=$this->direc;
        $BusinessListing=BusinessListing::find($buisness_id);
        return view('directory.editindividualbuissness',compact('direct','BusinessListing'));
    }
    public function updatebusiness(Request $request){
        $id=$request->input('id');
        $BusinessListing=BusinessListing::find($id);
        $BusinessListing->company_name=$request->input('company_name');
        $BusinessListing->website=$request->input('website');
        $BusinessListing->address=$request->input('address');
        $BusinessListing->phone=$request->input('phone');
        $BusinessListing->email_id=$request->input('email_id');
        $BusinessListing->save();
        return \Redirect::back()->with('success','call sequenced in progress')->withInput();
    }
}
