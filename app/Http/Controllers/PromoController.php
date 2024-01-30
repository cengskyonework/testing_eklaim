<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;
use App\ListDocument;
use Validator;
use Illuminate\Validation\Rule;

class PromoController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $promo = Promo::where("category","=","Promo")->orderBy("id", "desc")->get();
        return view('backend.promo.list',compact('promo'));
    }
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.promo.create');
		}else{
           return view('backend.promo.modal.create');
		}
    }
	
	
	public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
		//	'image' => 'required|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('promo/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/promo/", $image);
		}
		
        $promo = new Promo();
	    $promo->name = $request->input('name');
		$promo->category = 'Promo';
		$promo->start_date = $request->input('start_date');
		$promo->end_date = $request->input('end_date');
		$promo->description = $request->input('description');
		$promo->wilayah = $request->input('wilayah');

		$promo->image = $image;
		
        $promo->save();
		     
		if(! $request->ajax()){
           return redirect('promo/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$promo]);
		}
        
   }
   
   
   public function show(Request $request,$id)
    {
        $promo = Promo::find($id);
		if(! $request->ajax()){
		    return view('backend.promo.view',compact('promo'));
		}else{
			return view('backend.promo.modal.view',compact('promo'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $promo = Promo::find($id);
		
		if(! $request->ajax()){
		   return view('backend.promo.edit',compact('promo','id'));
		}else{
           return view('backend.promo.modal.edit',compact('promo','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
		//	'image' => 'required|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('promo/list')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/promo/", $image);
		}
		
        $promo = Promo::find($id);;
	    $promo->name = $request->input('name');
		$promo->start_date = $request->input('start_date');
		$promo->end_date = $request->input('end_date');
		$promo->description = $request->input('description');
		$promo->wilayah = $request->input('wilayah');

		$promo->image = $image;
		
        $promo->save();
		     
		if(! $request->ajax()){
           return redirect('promo')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Updated Sucessfully'),'data'=>$promo]);
		}
        
   }
	
   
   public function destroy($id)
    {
        $promo = Promo::find($id);
        $promo->delete();
        return redirect('promo')->with('success',_lang('Deleted Sucessfully'));
    }
}
