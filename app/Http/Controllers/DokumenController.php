<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen;
use Validator;
use Illuminate\Validation\Rule;

class DokumenController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $dokumen = Dokumen::all()->sortByDesc("id");;
        return view('backend.dokumen.list',compact('dokumen'));
    }
	
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.dokumen.create');
		}else{
           return view('backend.dokumen.modal.create');
		}
    }
	
	 public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('dokumens/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $dokumen = new Dokumen();
		$dokumen->name = $request->input('name');
	    $dokumen->status = $request->input('status');
	
        $dokumen->save();
        
		if(! $request->ajax()){
           return redirect('dokumen/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$dokumen]);
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
        $dokumen = Dokumen::find($id);
		if(! $request->ajax()){
		    return view('backend.dokumen.view',compact('dokumen','id'));
		}else{
			return view('backend.dokumen.modal.view',compact('dokumen','id'));
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
        $dokumen = Dokumen::find($id);
		if(! $request->ajax()){
		   return view('backend.dokumen.edit',compact('dokumen','id'));
		}else{
           return view('backend.dokumen.modal.edit',compact('dokumen','id'));
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
			'status' => 'required'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('dokumens.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $dokumen = Dokumen::find($id);
		$dokumen->name = $request->input('name');
	    $dokumen->status = $request->input('status');
	
        $dokumen->save();
		
		if(! $request->ajax()){
           return redirect('dokumen')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$dokumen]);
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
        $dokumen = Dokumen::find($id);
        $dokumen->delete();
        return redirect('dokumen')->with('success',_lang('Deleted Sucessfully'));
    }
}
