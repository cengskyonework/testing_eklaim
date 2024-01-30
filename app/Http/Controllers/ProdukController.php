<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProdukImport;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function __construct()
    {
        
    }
	
	public function index()
    {
        $produk = Produk::all()->sortByDesc("id");;
        return view('backend.produk.list',compact('produk'));
    }
	
	
	public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.produk.create');
		}else{
           return view('backend.produk.modal.create');
		}
    }
	
	 public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'nama' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('produk/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    
		
        $produk = new Produk();
		$produk->kode = $request->input('kode');
		$produk->nama = $request->input('nama');
		$produk->category = $request->input('category');
	    $produk->status = $request->input('status');
	
        $produk->save();
        
		if(! $request->ajax()){
           return redirect('produk/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$produk]);
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
        $produk = Produk::find($id);
		if(! $request->ajax()){
		    return view('backend.produk.view',compact('produk','id'));
		}else{
			return view('backend.produk.modal.view',compact('produk','id'));
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
        $produk = Produk::where('id',$id)->firstOrFail();
		if(! $request->ajax()){
		   return view('backend.produk.edit',compact('produk','id'));
		}else{
           return view('backend.produk.modal.edit',compact('produk','id'));
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
			'nama' => 'required|max:191'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('produks.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
        	
		
        $produk = Produk::where('id',$id)->first();
		$produk->kode = $request->input('kode');
		$produk->nama = $request->input('nama');
		$produk->category = $request->input('category');
	    $produk->status = $request->input('status');
	
        $produk->save();
		
		if(! $request->ajax()){
           return redirect('produk')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$produk]);
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
        $produk = Produk::where('id',$id)->firstOrFail();
        $produk->delete();
		
        return redirect('produk')->with('success',_lang('Deleted Sucessfully'));
    }
	
	public function import_excel(Request $request) 
	{
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
		$file = $request->file('file');
		$nama_file = rand().$file->getClientOriginalName();
		
		$file->move(base_path('public/uploads/excel/'),$nama_file);
		
		Excel::import(new ProdukImport, base_path('public/uploads/excel/'.$nama_file));
		
		return redirect('produk')->with('success', _lang('Data Berhasil Diimport'));
	}
}
