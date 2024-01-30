<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Exports\ReportExport;
use App\Exports\ReportExportAcc;
use Excel;
use App\ClaimProduk;
use App\ClaimDokumen;
use Validator;
use Illuminate\Validation\Rule;

class ReportsController extends Controller
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
		$idx = \Auth::user()->id;
		
        $claim = Claim::all();
		
        return view('backend.reports.list',compact('claim'));
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $spr = Claim::find($id);
		$dokumen = ClaimDokumen::select([
                                    "claim_dokument.id as id", 
									"claim_dokument.*",		
									"dokumen.name AS name",
                                ])
                                ->join('dokumen', 'dokumen.id', 'document_id')
								->where('claim_dokument.claim_id',$id)
                                ->get();
								
		$produk = ClaimProduk::select([
                                    "claim_produk.id as id", 
									"claim_produk.*",		
									"produk.nama AS nama",
                                ])
                                ->join('produk', 'produk.id', 'produk_id')
								->where('claim_produk.claim_id',$id)
                                ->get();
												
		if(!$request->ajax()){
		    return view('backend.reports.view',compact('spr','id','dokumen','produk'));
		}else{
			return view('backend.reports.modal.view',compact('spr','id','dokumen','produk'));
		} 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function exports(Request $request)
    {
		$request->validate([
            'start_date' => 'bail|nullable|date',
            'end_date' => 'bail|nullable|date',
        ]);

        $params = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
			'cost_id' => $request->cost_id,
			'category_id' => $request->category_id,
			'distributor_id' => $request->distributor_id,
        ];
		
		if ($request->laporan == 1)
		{
			return Excel::download(new ReportExport($params), 'laporan-klaim-admin-export-'.date('Y-m-d').'.xlsx');
		}
		else
		{
			return Excel::download(new ReportExportAcc($params), 'laporan-klaim-accounting-export-'.date('Y-m-d').'.xlsx');
		}
    }
	
}
