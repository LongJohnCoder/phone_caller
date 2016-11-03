<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Directories;
use App\Model\BusinessListMapDirectory;
use View;

class AjaxController extends Controller
{
    //
    public function MoveToGenerate(Request $request){
    	
    	$directoryx=$request->input('directory');
    	$Directories=Directories::where('id','!=',$directoryx)->get();
    	
    	$selected=$request->input('select_business');
    	$sel="";
    	$num=0;
    	foreach ($selected as $key => $value) {
    		$num++;
    		if($sel==""){
    			$sel=$value;
    		}else{
    			$sel=$sel.",".$value;
    		}
    	}
    	//dd($request->all());
    	return view('ajax.moveto',compact('sel','Directories','num','directoryx'));
    }
    public function MoveOrCopy(Request $request){
    	$reqlist=$request->input('list_id');
		$explist_id=explode(',',$reqlist);
		$type=$request->input('type');
		$to=$request->input('to');
		$from=$request->input('from');
		if($type==1){
			foreach ($explist_id as $key => $value) {
				$countblist=BusinessListMapDirectory::where('directory_id',$to)->where('business_list_id',$value)->count();
				if($countblist==0){
				$BusinessListMapDirectory=new BusinessListMapDirectory;
	            $BusinessListMapDirectory->business_list_id=$value;
	            $BusinessListMapDirectory->directory_id=$to;
	            $BusinessListMapDirectory->save();
				}
			}
		}
		if($type==2){
			foreach ($explist_id as $key => $value) {
				$countblist=BusinessListMapDirectory::where('directory_id',$to)->where('business_list_id',$value)->count();
				if($countblist==0){
				$BusinessListMapDirectory=new BusinessListMapDirectory;
	            $BusinessListMapDirectory->business_list_id=$value;
	            $BusinessListMapDirectory->directory_id=$to;
	            $BusinessListMapDirectory->save();
				}
			}
			foreach ($explist_id as $key => $value) {
			$BusinessListMapDirectory=BusinessListMapDirectory::where('directory_id',$from)->where('business_list_id',$value)->delete();
			}
		}
    }
    public function CallForm(Request $request){
    	//dd($request->all());
    	$directoryx=$request->input('directory');
    	$Directories=Directories::where('id','!=',$directoryx)->get();	
    	$selected=$request->input('select_business');
    	$sel="";
    	$num=0;
    	foreach ($selected as $key => $value) {
    		$num++;
    		if($sel==""){
    			$sel=$value;
    		}else{
    			$sel=$sel.",".$value;
    		}
    	}
    	return view('ajax.callform',compact('sel','Directories','num','directoryx'));
    }
}
