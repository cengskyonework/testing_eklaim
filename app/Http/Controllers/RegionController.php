<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use Validator;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $region = Region::all()->sortByDesc("id");
        return view('backend.region.list',compact('region'));
    }
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.region.create');
		}else{
           return view('backend.region.modal.create');
		}
    }
	
	
	public function store(Request $request)
    {	
		
		$validator = Validator::make($request->all(), [
			'region_city' => 'required',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('region/list')
							->withErrors($validator)
							->withInput();
			}			
		}
		
		
        $region = new Region();
	    $region->region_city = $request->input('region_city');
		$region->region_address = $request->input('region_address');

        $region->save();
		     
		if(!$request->ajax()){
           return redirect('region/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$region]);
		}
        
   }
   
   
   public function show(Request $request,$id)
    {
        $region = Region::where('id',$id)->firstOrFail();
		if(! $request->ajax()){
		    return view('backend.region.view',compact('region'));
		}else{
			return view('backend.region.modal.view',compact('region'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $region = Region::where('id',$id)->firstOrFail();
		
		if(! $request->ajax()){
		   return view('backend.region.edit',compact('region','id'));
		}else{
           return view('backend.region.modal.edit',compact('region','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {	
		$validator = Validator::make($request->all(), [
			'region_city' => 'required',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('region/list')
							->withErrors($validator)
							->withInput();
			}			
		}
			
		
        $region = Region::where('id',$id)->first();
	    $region->region_city = $request->input('region_city');
		$region->region_address = $request->input('region_address');
		
        $region->save();
		     
		if(! $request->ajax()){
           return redirect('region/list')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Update  Sucessfully'),'data'=>$region]);
		}
        
   }
	
   
   public function destroy($id)
    {
        $region = Region::where('id',$id)->first();
        $region->delete();
        return redirect('region')->with('success',_lang('Deleted Sucessfully'));
    }
}
