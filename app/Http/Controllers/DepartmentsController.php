<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use Validator;
use Illuminate\Validation\Rule;

class DepartmentsController extends Controller
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
        $departments = Departments::all()->sortByDesc("id");
        return view('backend.department.list',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.department.create');
		}else{
           return view('backend.department.modal.create');
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
			'department_name' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('departments/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $department = new Departments();
		$department->department_code = $request->input('department_code');
	    $department->department_name = $request->input('department_name');
	
        $department->save();
        
		if(! $request->ajax()){
           return redirect('department/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$department]);
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
        $department = Departments::find($id);
		if(! $request->ajax()){
		    return view('backend.department.view',compact('department','id'));
		}else{
			return view('backend.department.modal.view',compact('department','id'));
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
        $department = Departments::find($id);
		if(! $request->ajax()){
		   return view('backend.department.edit',compact('department','id'));
		}else{
           return view('backend.department.modal.edit',compact('department','id'));
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
			'department_name' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('departments.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $department = Departments::find($id);
		$department->department_code = $request->input('department_code');
	    $department->department_name = $request->input('department_name');
	
        $department->save();
		
		if(! $request->ajax()){
           return redirect('department')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$department]);
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
        $department = Departments::find($id);
        $department->delete();
        return redirect('department')->with('success',_lang('Deleted Sucessfully'));
    }
	 
}
