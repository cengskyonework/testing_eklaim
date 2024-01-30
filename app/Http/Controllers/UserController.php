<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserAkses;
use App\CostCenter;
use Validator;
use Hash;

class UserController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortByDesc("id");
        return view('backend.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$level = CostCenter::where("id","<>",103)->orderBy("id", "desc")->get();
		
		if( ! $request->ajax()){
		   return view('backend.user.create',compact('level'));
		}else{
           return view('backend.user.modal.create',compact('level'));
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
			'email' => 'required|email|unique:users|max:191',
			'password' => 'required|max:20|min:6|confirmed',
			'user_type' => 'required',
			'status' => 'required',
			'profile_picture' => 'nullable|image|max:5120',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('users/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
        $user= new User();
	    $user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->password);
		$user->user_type = $request->input('user_type');
		$user->status = $request->input('status');
	    if ($request->hasFile('profile_picture')){
           $image = $request->file('profile_picture');
           $file_name = "profile_".time().'.'.$image->getClientOriginalExtension();
           $image->move(base_path('public/uploads/profile/'),$file_name);
           $user->profile_picture = $file_name;
		}
        $user->save();
		
		//Prefix Output
		$user->user_type = ucwords($user->user_type);
		$user->status = $user->status == 1 ? _lang('Active') : _lang('In-Active');
        
		if(! $request->ajax()){
           return redirect('users/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$user]);
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
        $user = User::find($id);
		if(! $request->ajax()){
		    return view('backend.user.view',compact('user','id'));
		}else{
			return view('backend.user.modal.view',compact('user','id'));
		} 
        
    }
	
	public function buat_akses(Request $request,$id)
    {
        $user = User::find($id);
		$level = CostCenter::where("id","<>",103)->orderBy("id", "desc")->get();
		
		return view('backend.user.view',compact('user','level','id'));  
    }
	
	public function edit_akses(Request $request,$id)
    {
        $user = User::find($id);
		$inserted_fac = DB::table('user_akses')->where('user_id', $id)->get();
		$total_property = DB::table('user_akses')->where('user_id', $id)->count();
		$level = CostCenter::where("id","<>",103)->orderBy("id", "desc")->get();
		
		return view('backend.user.edit_akses',compact('user','level','inserted_fac','id','total_property'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::find($id);
		if(! $request->ajax()){
		   return view('backend.user.edit',compact('user','id'));
		}else{
           return view('backend.user.modal.edit',compact('user','id'));
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
                Rule::unique('users')->ignore($id),
            ],
			'password' => 'nullable|max:20|min:6|confirmed',
			'user_type' => 'required',
			'status' => 'required',
			'profile_picture' => 'nullable|image|max:5120',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('users.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		if($request->password){
            $user->password = Hash::make($request->password);
        }
		$user->user_type = $request->input('user_type');
		$user->status = $request->input('status');
	    if ($request->hasFile('profile_picture')){
           $image = $request->file('profile_picture');
           $file_name = "profile_".time().'.'.$image->getClientOriginalExtension();
           $image->move(base_path('public/uploads/profile/'),$file_name);
           $user->profile_picture = $file_name;
		}
        $user->save();
		
		//Prefix Output
		$user->user_type = ucwords($user->user_type);
		$user->status = $user->status == 1 ? _lang('Active') : _lang('In-Active');
        
		
		if(! $request->ajax()){
           return redirect('users')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$user]);
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
        $user = User::find($id);
        $user->delete();
        return redirect('users')->with('success',_lang('Removed Sucessfully'));
    }
	
	
	public function simpan_akses(Request $request, $id)
    {
		
		$now = now();
		//$empid = User::where('id', $request->user_id)->first();
		
        DB::table('users')->where('id',$id)->update([
				'akses' => 2,
            ]);
		
		DB::table('user_akses')->where('user_id',$id)->delete();
		
		$UnitsData = [];
            foreach ($request->cost_id as $item) {
                $UnitsData[] = [
                    'user_id' => $id,
                    'cost_id' => $item,
					'created_at' => $now,
                ];
            }
        DB::table('user_akses')->insert($UnitsData);
		
		return redirect('users')->with('success',_lang('Setting Akses Sucessfully'));
    }
	
	
}
