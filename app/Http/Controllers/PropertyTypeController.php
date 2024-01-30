<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyType;
use Validator;
use Illuminate\Validation\Rule;

class PropertyTypeController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertytypes = PropertyType::all()->sortByDesc("id");
        return view('backend.property_type.list',compact('propertytypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.property_type.create');
		}else{
           return view('backend.property_type.modal.create');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'type' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('property_types/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $propertytype = new PropertyType();
	    $propertytype->type = $request->input('type');
	
        $propertytype->save();
        
		if(! $request->ajax()){
           return redirect('property_types/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$propertytype]);
		}
        
   }
	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $propertytype = PropertyType::find($id);
		if(! $request->ajax()){
		    return view('backend.property_type.view',compact('propertytype','id'));
		}else{
			return view('backend.property_type.modal.view',compact('propertytype','id'));
		} 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $propertytype = PropertyType::find($id);
		if(! $request->ajax()){
		   return view('backend.property_type.edit',compact('propertytype','id'));
		}else{
           return view('backend.property_type.modal.edit',compact('propertytype','id'));
		}  
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			'type' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('property_types.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $propertytype = PropertyType::find($id);
		$propertytype->type = $request->input('type');
	
        $propertytype->save();
		
		if(! $request->ajax()){
           return redirect('property_types')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$propertytype]);
		}
	    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertytype = PropertyType::find($id);
        $propertytype->delete();
        return redirect('property_types')->with('success',_lang('Deleted Sucessfully'));
    }
}
