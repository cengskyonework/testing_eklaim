<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Benefit;
use Validator;
use Illuminate\Validation\Rule;

class BenefitController extends Controller
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
        $benefits = Benefit::all()->sortByDesc("id");
        return view('backend.benefit.list',compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.benefit.create');
		}else{
           return view('backend.benefit.modal.create');
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
			'name' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('benefits/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $benefit = new Benefit();
	    $benefit->name = $request->input('name');
	
        $benefit->save();
        
		if(! $request->ajax()){
           return redirect('benefits/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$benefit]);
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
        $benefit = Benefit::find($id);
		if(! $request->ajax()){
		    return view('backend.benefit.view',compact('benefit','id'));
		}else{
			return view('backend.benefit.modal.view',compact('benefit','id'));
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
        $benefit = Benefit::find($id);
		if(! $request->ajax()){
		   return view('backend.benefit.edit',compact('benefit','id'));
		}else{
           return view('backend.benefit.modal.edit',compact('benefit','id'));
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
			'name' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('benefits.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $benefit = Benefit::find($id);
		$benefit->name = $request->input('name');
	
        $benefit->save();
		
		if(! $request->ajax()){
           return redirect('benefits')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$benefit]);
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
        $benefit = Benefit::find($id);
        $benefit->delete();
        return redirect('benefits')->with('success',_lang('Deleted Sucessfully'));
    }
}
