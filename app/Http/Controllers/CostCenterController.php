<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CostImport;
use App\CostCenter;
use App\ListDocument;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class CostCenterController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $costcenter = CostCenter::where("id","<>",103)->orderBy("id", "desc")->get();
        return view('backend.costcenter.list',compact('costcenter'));
    }
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.costcenter.create');
		}else{
           return view('backend.costcenter.modal.create');
		}
    }
	
	
	public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'cost_name' => 'required|max:191',
		//	'image' => 'required|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('costcenter/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/costcenter/", $image);
		}
		
        $costcenter = new CostCenter();
	    $costcenter->cost_number = $request->input('cost_number');
		$costcenter->cost_name = $request->input('cost_name');
		$costcenter->cost_code = $request->input('cost_code');
		$costcenter->chanel_id = $request->input('chanel_id');
		$costcenter->appv1 = $request->input('appv1');
		$costcenter->appv2 = $request->input('appv2');
		$costcenter->appv3 = $request->input('appv3');
		$costcenter->appv4 = $request->input('appv4');
		$costcenter->appv5 = $request->input('appv5');
		$costcenter->appv6 = $request->input('appv6');
		$costcenter->appv7 = $request->input('appv7');
		$costcenter->appv8 = $request->input('appv8');
		$costcenter->appv9 = $request->input('appv9');
		$costcenter->appv10 = $request->input('appv10');


		//$costcenter->image = $image;
		
        $costcenter->save();
		     
		if(! $request->ajax()){
           return redirect('costcenter')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$costcenter]);
		}
        
   }
   
   
   public function show(Request $request,$id)
    {
        $costcenter = CostCenter::find($id);
		if(! $request->ajax()){
		    return view('backend.costcenter.view',compact('costcenter'));
		}else{
			return view('backend.costcenter.modal.view',compact('costcenter'));
		} 
        
    }
	
	public function edit(Request $request,$id)
    {
        $costcenter = CostCenter::find($id);
		
		if(! $request->ajax()){
		   return view('backend.costcenter.edit',compact('costcenter','id'));
		}else{
           return view('backend.costcenter.modal.edit',compact('costcenter','id'));
		}  
        
    }
	
	public function update(Request $request, $id)
    {	
		$validator = Validator::make($request->all(), [
			'cost_name' => 'required|max:191',
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('costcenter/list')
							->withErrors($validator)
							->withInput();
			}			
		}	
		
        $costcenter = CostCenter::find($id);
	    $costcenter->cost_number = $request->input('cost_number');
		$costcenter->cost_name = $request->input('cost_name');
		$costcenter->cost_code = $request->input('cost_code');
		$costcenter->chanel_id = $request->input('chanel_id');
		$costcenter->appv1 = $request->input('appv1');
		$costcenter->appv2 = $request->input('appv2');
		$costcenter->appv3 = $request->input('appv3');
		$costcenter->appv4 = $request->input('appv4');
		$costcenter->appv5 = $request->input('appv5');
		$costcenter->appv6 = $request->input('appv6');
		$costcenter->appv7 = $request->input('appv7');
		$costcenter->appv8 = $request->input('appv8');
		$costcenter->appv9 = $request->input('appv9');
		$costcenter->appv10 = $request->input('appv10');


		
        $costcenter->save();
		     
		if(! $request->ajax()){
           return redirect('costcenter')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$costcenter]);
		}
        
   }
	
   
   public function destroy($id)
    {
        $costcenter = CostCenter::find($id);
        $costcenter->delete();
        return redirect('costcenter')->with('success',_lang('Deleted Sucessfully'));
    }
	
	public function import_excel(Request $request) 
	{
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
		$file = $request->file('file');
		$nama_file = rand().$file->getClientOriginalName();
		
		$file->move(base_path('public/uploads/excel/'),$nama_file);
		
		Excel::import(new CostImport, base_path('public/uploads/excel/'.$nama_file));
		
		return redirect('costcenter')->with('success', _lang('Data Berhasil Diimport'));
	}
}
