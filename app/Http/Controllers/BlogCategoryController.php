<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;
use Validator;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
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
        $blogcategorys = BlogCategory::all()->sortByDesc("id");
        return view('backend.blog_category.list',compact('blogcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.blog_category.create');
		}else{
           return view('backend.blog_category.modal.create');
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
		'description' => ''
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('blog_categories/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $blogcategory = new BlogCategory();
	    $blogcategory->name = $request->input('name');
	$blogcategory->description = $request->input('description');
	
        $blogcategory->save();
        
		if(! $request->ajax()){
           return redirect('blog_categories/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$blogcategory]);
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
        $blogcategory = BlogCategory::find($id);
		if(! $request->ajax()){
		    return view('backend.blog_category.view',compact('blogcategory','id'));
		}else{
			return view('backend.blog_category.modal.view',compact('blogcategory','id'));
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
        $blogcategory = BlogCategory::find($id);
		if(! $request->ajax()){
		   return view('backend.blog_category.edit',compact('blogcategory','id'));
		}else{
           return view('backend.blog_category.modal.edit',compact('blogcategory','id'));
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
		'description' => ''
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('blog_categories.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $blogcategory = BlogCategory::find($id);
		$blogcategory->name = $request->input('name');
	$blogcategory->description = $request->input('description');
	
        $blogcategory->save();
		
		if(! $request->ajax()){
           return redirect('blog_categories')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$blogcategory]);
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
        $blogcategory = BlogCategory::find($id);
        $blogcategory->delete();
        return redirect('blog_categories')->with('success',_lang('Deleted Sucessfully'));
    }
}
