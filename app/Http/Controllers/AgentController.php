<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;
use Validator;
use Illuminate\Validation\Rule;

class AgentController extends Controller
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
        $agents = Agent::all()->sortByDesc("id");
        return view('backend.agent.list',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.agent.create');
		}else{
           return view('backend.agent.modal.create');
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
			'name' => 'required|max:191',
			'email' => 'required|email|unique:agents|max:255',
			'image' => 'required|image',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('agents/create')
							->withErrors($validator)
							->withInput();
			}			
		}
		
		$image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/media/", $image);
		}
		
        $agent = new Agent();
	    $agent->name = $request->input('name');
		$agent->email = $request->input('email');
		$agent->phone = $request->input('phone');
		$agent->address = $request->input('address');
		$agent->description = $request->input('description');
		$agent->image = $image;
		$agent->facebook = $request->input('facebook');
		$agent->twitter = $request->input('twitter');
		$agent->linkedin = $request->input('linkedin');
	
        $agent->save();
		
		//Prefix Output
		$agent->image = '<img src="'.asset('public/uploads/media/'.$agent->image).'" class="img-md">';
        
		if(! $request->ajax()){
           return redirect('agents/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$agent]);
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
        $agent = Agent::find($id);
		if(! $request->ajax()){
		    return view('backend.agent.view',compact('agent','id'));
		}else{
			return view('backend.agent.modal.view',compact('agent','id'));
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
        $agent = Agent::find($id);
		if(! $request->ajax()){
		   return view('backend.agent.edit',compact('agent','id'));
		}else{
           return view('backend.agent.modal.edit',compact('agent','id'));
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
			'name' => 'required|max:191',
			'email' => [
                'required',
                Rule::unique('agents')->ignore($id),
            ],
			'image' => 'nullable|image',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('agents.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/media/", $image);
		}	
		
        $agent = Agent::find($id);
		$agent->name = $request->input('name');
		$agent->email = $request->input('email');
		$agent->phone = $request->input('phone');
		$agent->address = $request->input('address');
		$agent->description = $request->input('description');
		if($request->hasfile('image')){
			$agent->image = $image;
		}
		$agent->facebook = $request->input('facebook');
		$agent->twitter = $request->input('twitter');
		$agent->linkedin = $request->input('linkedin');
	
        $agent->save();
		
		//Prefix Output
		$agent->image = '<img src="'.asset('public/uploads/media/'.$agent->image).'" class="img-md">';
        
		
		if(! $request->ajax()){
           return redirect('agents')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$agent]);
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
        $agent = Agent::find($id);
        $agent->delete();
        return redirect('agents')->with('success',_lang('Deleted Sucessfully'));
    }
}
