<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ListDocument;
use Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $category = Category::orderBy("id", "desc")->get();
        return view('backend.category.list',compact('category'));
    }
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.category.create');
		}else{
           return view('backend.category.modal.create');
		}
    }
	
	
	public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('category/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/category/", $image);
		}
		
        $category = new Category();
		$category->name = $request->input('name');
		$category->status = $request->input('status');


		//$category->image = $image;
		
        $category->save();
		     
		if(! $request->ajax()){
           return redirect('category')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$category]);
		}
        
   }
   
   
   public function show(Request $request,$id)
    {
        $category = Category::find($id);
		if(! $request->ajax()){
		    return view('backend.category.view',compact('category'));
		}else{
			return view('backend.category.modal.view',compact('category'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $category = Category::find($id);
		
		if(! $request->ajax()){
		   return view('backend.category.edit',compact('category','id'));
		}else{
           return view('backend.category.modal.edit',compact('category','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('category/list')
							->withErrors($validator)
							->withInput();
			}			
		}	
		
        $category = Category::find($id);
		$category->name = $request->input('name');
		$category->status = $request->input('status');


		
        $category->save();
		     
		if(! $request->ajax()){
           return redirect('category')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$category]);
		}
        
   }
	
   
   public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('category')->with('success',_lang('Deleted Sucessfully'));
    }
}
