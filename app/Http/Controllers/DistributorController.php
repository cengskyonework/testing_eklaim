<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distributor;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use Hash;

class DistributorController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $distributor = Distributor::where("status","=", 1)->orderBy("id", "desc")->get();
        return view('backend.distributor.list',compact('distributor'));
    }
	
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.distributor.create');
		}else{
           return view('backend.distributor.modal.create');
		}
    }
	
	public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
			'hp' => 'required|max:13',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('distributor/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/ktp/", $image);
		}
		
        $distributor = new Distributor();
		$distributor->no_distributor = $request->input('no_distributor');
	    $distributor->name = $request->input('name');
		$distributor->id_no = $request->input('id_no');
		$distributor->npwp = $request->input('npwp');
		$distributor->hp = $request->input('hp');
		$distributor->email = $request->input('email');
		$distributor->jenis_usaha = $request->input('jenis_usaha');
		$distributor->address = $request->input('address');
		$distributor->keterangan = $request->input('keterangan');
		$distributor->distributor_id = $request->input('distributor_id');
		$distributor->bank_id = $request->input('bank_id');
		$distributor->region_id = $request->input('region_id');
		$distributor->no_rek = $request->input('no_rek');
		$distributor->nama_rek = $request->input('nama_rek');
		$distributor->created_by = \Auth::user()->id;

		$distributor->image = $image;
		
        $distributor->save();
		
		$emailin = $request->input('email');
		
		$cek = User::where('email',$emailin)->count();
		
		if($cek > 0)
		{
			$user = User::where('email', $emailin)->first();
			$user->name = $request->input('name');
			$user->password = Hash::make($request->input('password'));
			$user->status = 1;
			$user->distri_id = $distributor->id;
			$user->save();
		}
		else
		{
			$user = new User();
			$user->name = $request->input('name');
			$user->password = Hash::make($request->input('password'));
			$user->email = $request->input('email');
			$user->user_type = 'user';
			$user->status = 1;
			$user->distri_id = $distributor->id;
			$user->save();
		}
		
		     
		if(! $request->ajax()){
           return redirect('distributor/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$distributor]);
		}
        
   }
   
    public function show(Request $request,$id)
    {
        $distributor = Distributor::find($id);

		if(! $request->ajax()){
		    return view('backend.distributor.view',compact('distributor'));
		}else{
			return view('backend.distributor.modal.view',compact('distributor'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $distributor = Distributor::find($id);
		if(! $request->ajax()){
		   return view('backend.distributor.edit',compact('distributor','id'));
		}else{
           return view('backend.distributor.modal.edit',compact('distributor','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
			'hp' => 'required|max:13',
			'email' => 'required',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('distributor.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/ktp/", $image);
		}	
        	
		
        $distributor = Distributor::find($id);
	    $distributor->name = $request->input('name');
		$distributor->no_distributor = $request->input('no_distributor');
		$distributor->id_no = $request->input('id_no');
		$distributor->npwp = $request->input('npwp');
		$distributor->hp = $request->input('hp');
		$distributor->email = $request->input('email');
		$distributor->jenis_usaha = $request->input('jenis_usaha');
		$distributor->address = $request->input('address');
		$distributor->keterangan = $request->input('keterangan');
		$distributor->distributor_id = $request->input('distributor_id');
		$distributor->region_id = $request->input('region_id');
		$distributor->bank_id = $request->input('bank_id');
		$distributor->no_rek = $request->input('no_rek');
		$distributor->nama_rek = $request->input('nama_rek');
		$distributor->updated_by = \Auth::user()->id;
		
		$distributor->save();
		
		if($request->hasfile('image')){
			$distributor->image = $image;
		}

		$distributor->save();
						
		if(! $request->ajax()){
           return redirect('distributor')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Updated Sucessfully'),'data'=>$distributor]);
		}
	    
    }
	
	
	public function destroy($id)
    {
        $distributor = Distributor::where('id',$id)->first();
        $distributor->delete();
		
		$cek = User::where('distri_id',$id)->count();
		
		if($cek > 0)
		{
			$user = User::where('distri_id',$id)->first();
			$user->delete();
		}
		
        return redirect('distributor')->with('success',_lang('Deleted Sucessfully'));
    }
	
	
}
