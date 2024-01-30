<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class BlogController extends Controller
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
        $blogs = Blog::all()->sortByDesc("id");
        return view('backend.blog_post.list',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.blog_post.create');
		}else{
           return view('backend.blog_post.modal.create');
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
			'title' => 'required',
			'cat_id' => 'required',
			'status' => 'required',
			'featured_image' => 'nullable|image',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('blog_posts/create')
							->withErrors($validator)
							->withInput();
			}			
		}
		
		$featured_image = '';		
	    if($request->hasfile('featured_image'))
		  {
			 $file = $request->file('featured_image');
			 $featured_image = time().str_replace(' ','_',$file->getClientOriginalName());
			 $file->move(public_path()."/uploads/media/", $featured_image);
		  }
		
        $blog = new Blog();
	    $blog->title = $request->input('title');
		$blog->excerpt = $request->input('excerpt');
		$blog->content = $request->input('content');
		$blog->cat_id = $request->input('cat_id');
		$blog->post_type = $request->input('post_type');
		$blog->status = $request->input('status');
		$blog->featured_image = $featured_image;
		$blog->author_id = Auth::User()->id;
	
        $blog->save();
		
		//Prefix Output
		$blog->title = substr($blog->title,0,20).' . . .';
        
		if(! $request->ajax()){
           return redirect('blog_posts/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$blog]);
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
        $blog = Blog::find($id);
		if(! $request->ajax()){
		    return view('backend.blog_post.view',compact('blog','id'));
		}else{
			return view('backend.blog_post.modal.view',compact('blog','id'));
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
        $blog = Blog::find($id);
		if(! $request->ajax()){
		   return view('backend.blog_post.edit',compact('blog','id'));
		}else{
           return view('backend.blog_post.modal.edit',compact('blog','id'));
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
			'title' => 'required',
			'cat_id' => 'required',
			'status' => 'required',
			'featured_image' => 'nullable|image',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('blog_posts.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        if($request->hasfile('featured_image'))
		  {
			 $file = $request->file('featured_image');
			 $featured_image = time().str_replace(' ','_',$file->getClientOriginalName());
			 $file->move(public_path()."/uploads/media/", $featured_image);
		  }	
		
        $blog = Blog::find($id);
		$blog->title = $request->input('title');
		$blog->excerpt = $request->input('excerpt');
		$blog->content = $request->input('content');
		$blog->cat_id = $request->input('cat_id');
		$blog->post_type = $request->input('post_type');
		$blog->status = $request->input('status');
		if($request->hasfile('featured_image')){
			$blog->featured_image = $featured_image;
		}
		$blog->author_id = Auth::User()->id;
	
        $blog->save();
		
		//Prefix Output
		$blog->title = substr($blog->title,0,20).' . . .';
		
		if(! $request->ajax()){
           return redirect('blog_posts')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$blog]);
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
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('blog_posts')->with('success',_lang('Deleted Sucessfully'));
    }
}
