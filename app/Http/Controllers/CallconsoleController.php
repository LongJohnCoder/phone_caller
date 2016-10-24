<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Model\Directories;
use App\Model\BusinessListing;
use DOMDocument;
class CallconsoleController extends Controller
{
    //
    public function addcall(){
		$direct=$this->direc;
    	return view('callstack.add',compact('direct'));

	}
	public function saveexces(Request $request){
		//dd($request->all());
		$avatar =$request->file('audio');
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
            $destinationPath = 'audio/';
            $newfilename = rand(1000, 9999)."-".date('U').'.'.$extension;
            $uploadSuccess = $avatar->move($destinationPath, $newfilename);
            $typ=$request->input('optionsRadios');
            $exc= $this->generateXml($typ,$newfilename);
            
        }
	}
	public function generateXml($typ,$newfilename){
		echo $typ;
		echo "<br>";
		echo $newfilename;
		$fpath=url('/')."/audio/".$newfilename;
		//exit;
		
		$domtree = new DOMDocument('1.0', 'UTF-8');
		$xmlRoot = $domtree->createElement("Response");
		$xmlRoot = $domtree->appendChild($xmlRoot);
		$currentTrack = $domtree->createElement("Say","hallo Hi");
		$currentTrack = $xmlRoot->appendChild($currentTrack);
		$currentTrack = $domtree->createElement("Play",$fpath);
		$currentTrack = $xmlRoot->appendChild($currentTrack);
		
		$domtree->save("callforma/Track.xml");
	}
}
