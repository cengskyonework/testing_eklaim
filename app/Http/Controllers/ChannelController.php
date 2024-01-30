<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\ListDocument;
use Validator;
use Illuminate\Validation\Rule;

class ChannelController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $channel = Channel::where("id","<>",47)->orderBy("id", "desc")->get();
        return view('backend.channel.list',compact('channel'));
    }
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.channel.create');
		}else{
           return view('backend.channel.modal.create');
		}
    }
	
	
	public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'chanel_name' => 'required|max:191',
		//	'image' => 'required|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('channel/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/channel/", $image);
		}
		
        $channel = new Channel();
		$channel->chanel_name = $request->input('chanel_name');
		$channel->status = $request->input('status');


		//$channel->image = $image;
		
        $channel->save();
		     
		if(! $request->ajax()){
           return redirect('channel')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$channel]);
		}
        
   }
   
   
   public function show(Request $request,$id)
    {
        $channel = Channel::find($id);
		if(! $request->ajax()){
		    return view('backend.channel.view',compact('channel'));
		}else{
			return view('backend.channel.modal.view',compact('channel'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $channel = Channel::find($id);
		
		if(! $request->ajax()){
		   return view('backend.channel.edit',compact('channel','id'));
		}else{
           return view('backend.channel.modal.edit',compact('channel','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {	
		$validator = Validator::make($request->all(), [
			'chanel_name' => 'required|max:191',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('channel/list')
							->withErrors($validator)
							->withInput();
			}			
		}	
		
        $channel = Channel::find($id);
		$channel->chanel_name = $request->input('chanel_name');
		$channel->status = $request->input('status');


		
        $channel->save();
		     
		if(! $request->ajax()){
           return redirect('channel')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$channel]);
		}
        
   }
	
   
   public function destroy($id)
    {
        $channel = Channel::find($id);
        $channel->delete();
        return redirect('channel')->with('success',_lang('Deleted Sucessfully'));
    }
}
