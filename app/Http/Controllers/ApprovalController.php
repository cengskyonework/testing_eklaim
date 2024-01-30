<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\ClaimNote;
use App\ClaimProduk;
use App\ClaimDokumen;
use App\ClaimFlowDokumen;
use App\ClaimApproval;
use App\Mail\AssignMail;
use App\Mail\ManagerMail;
use App\CostCenter;
use Validator;
use App\User;
use Auth;
use App\Utilities\Overrider;
use Illuminate\Validation\Rule;

class ApprovalController extends Controller
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
		
        $claim = Claim::where('approved_by',$idx)->where('flag_acc', 1)->where('status','!=','D')->get();
		
        return view('backend.approval.list',compact('claim'));
    }
	
	public function konfirm_acc(Request $request,$id)
    {
		$transaktions = Claim::find($id);
		$appx = ClaimFlowDokumen::where('claim_id',$id)->get();
		if(! $request->ajax()){
		   return view('backend.approval.edit',compact('transaktions','appx','id'));
		}else{
           return view('backend.approval.modal.edit',compact('transaktions','appx','id'));
		}
    }
	
	public function validasi_acc(Request $request,$id)
    {
		$spr = Claim::find($id);
		$produk = ClaimProduk::select([
                                    "claim_produk.id as id", 
									"claim_produk.*",		
									"produk.nama AS nama",
                                ])
                                ->join('produk', 'produk.id', 'produk_id')
								->where('claim_produk.claim_id',$id)
                                ->get();
		if(! $request->ajax()){
		   return view('backend.approval.validasi',compact('spr','produk','id'));
		}else{
           return view('backend.approval.modal.validasi',compact('spr','produk','id'));
		}
    }
	
	public function konfirm_fat(Request $request,$id)
    {
		$transaktions = Claim::find($id);
		$appx = ClaimFlowDokumen::where('claim_id',$id)->get();
		if(! $request->ajax()){
		   return view('backend.approval.edit_fat',compact('transaktions','appx','id'));
		}else{
           return view('backend.approval.modal.edit_fat',compact('transaktions','appx','id'));
		}
    }
	
	public function finance_approval()
    {	
        $claim = Claim::where('status','!=','D')->where('flag_acc',2)->orwhere('flag_acc',3)->get();
		
        return view('backend.approval.listfat',compact('claim'));
    }
	
	public function acc_approval()
    {
        $claim = Claim::where('status','!=','D')->where('flag_acc',4)->orwhere('flag_acc',5)->get();		
        return view('backend.approval.listacc',compact('claim'));
    }

    public function show(Request $request,$id)
    {
        $spr = Claim::find($id);
		$notes = ClaimNote::where('claim_id',$id)->get();
		$app = ClaimApproval::where('claim_id',$id)->get();
		$appz = ClaimFlowDokumen::where('claim_id',$id)->get();
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
		    return view('backend.approval.view',compact('spr','id','app','appz','dokumen','produk','notes'));
		}else{
			return view('backend.approval.modal.view',compact('spr','id','app','appz','dokumen','produk','notes'));
		} 
        
    }
	
	public function apvfat(Request $request,$id)
    {
        $spr = Claim::find($id);
		$notes = ClaimNote::where('claim_id',$id)->get();
		$app = ClaimApproval::where('claim_id',$id)->get();
		$appz = ClaimFlowDokumen::where('claim_id',$id)->get();
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
		    return view('backend.approval.viewfat',compact('spr','app','appz','id','dokumen','produk','notes'));
		}else{
			return view('backend.approval.modal.viewfat',compact('spr','app','appz','id','dokumen','produk','notes'));
		} 
        
    }
	
	public function apvacc(Request $request,$id)
    {
        $spr = Claim::find($id);
		$notes = ClaimNote::where('claim_id',$id)->get();
		$app = ClaimApproval::where('claim_id',$id)->get();
		$appz = ClaimFlowDokumen::where('claim_id',$id)->get();
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
		    return view('backend.approval.viewacc',compact('spr','app','appz','id','dokumen','produk','notes'));
		}else{
			return view('backend.approval.modal.viewacc',compact('spr','app','appz','id','dokumen','produk','notes'));
		} 
        
    }

	public function approved(request $request){
        $id = $request->input('claim_id');
        $ApprovalNote = $request->input('ApprovalNote');
        $status = $request->input('ApprovalSts');
		$inped = $request->input('internal_pend');
		$apv = $request->input('apv_ke');
		$cost = $request->input('cost_id');
		$EmployeeId = \Auth::user()->id;
		
		 if($apv == 1)
		 {
			$cekapp = CostCenter::selectRaw("appv2")
							->where('id',$cost)
							->first();
										
			if($cekapp->appv2 == null)
			{ 
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->approved_by = NULL;
						$dokumen->internal_pend = 0;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 2;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv2;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv2)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status = $status;
			$approval->approved_1 = $EmployeeId;
			$approval->note_appv1 = $ApprovalNote;
			$approval->approved_1_date = now();
			
			$approval->save();
			
			
			
		 }		 
		 else if($apv == 2)
		 {
			$cekapp = CostCenter::selectRaw("appv3")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv3 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 3;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv3;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv3)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status2 = $status;
			$approval->approved_2 = $EmployeeId;
			$approval->note_appv2 = $ApprovalNote;
			$approval->approved_2_date = now();
			
			$approval->save();
		 }
		 //newer tambahan
		 else if($apv == 3)
		 {
			$cekapp = CostCenter::selectRaw("appv4")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv4 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 4;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv4;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv4)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status3 = $status;
			$approval->approved_3 = $EmployeeId;
			$approval->note_appv3 = $ApprovalNote;
			$approval->approved_3_date = now();
			
			$approval->save();
		 }
		 //5---------------------------------------------------------------------
		 else if($apv == 4)
		 {
			$cekapp = CostCenter::selectRaw("appv5")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv5 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 5;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv5;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv5)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status4 = $status;
			$approval->approved_4 = $EmployeeId;
			$approval->note_appv4 = $ApprovalNote;
			$approval->approved_4_date = now();
			
			$approval->save();
		 }
		 
		 
		 //6---------------------------------------------------------------------
		 else if($apv == 5)
		 {
			$cekapp = CostCenter::selectRaw("appv6")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv6 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 6;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv6;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv6)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status5 = $status;
			$approval->approved_5 = $EmployeeId;
			$approval->note_appv5 = $ApprovalNote;
			$approval->approved_5_date = now();
			
			$approval->save();
		 }
		 
		 //7---------------------------------------------------------------------
		 else if($apv == 6)
		 {
			$cekapp = CostCenter::selectRaw("appv7")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv7 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 7;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv7;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv7)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status6 = $status;
			$approval->approved_6 = $EmployeeId;
			$approval->note_appv6 = $ApprovalNote;
			$approval->approved_6_date = now();
			
			$approval->save();
		 }
		 
		 //8---------------------------------------------------------------------
		 else if($apv == 7)
		 {
			$cekapp = CostCenter::selectRaw("appv8")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv8 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 8;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv8;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv8)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status7 = $status;
			$approval->approved_7 = $EmployeeId;
			$approval->note_appv7 = $ApprovalNote;
			$approval->approved_7_date = now();
			
			$approval->save();
		 }
		 
		 //9
		 else if($apv == 8)
		 {
			$cekapp = CostCenter::selectRaw("appv9")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv9 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 9;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv9;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv9)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status8 = $status;
			$approval->approved_8 = $EmployeeId;
			$approval->note_appv8 = $ApprovalNote;
			$approval->approved_8_date = now();
			
			$approval->save();
		 }
		 //10
		 else if($apv == 9)
		 {
			$cekapp = CostCenter::selectRaw("appv10")
							->where('id',$cost)
							->first();
							
			if ($cekapp->appv10 == null)
			{
				if($status == 1)
				{
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
				
				
			}
			else
			{
				if($status == 1)
				{
					$dxc = Claim::find($id);
					$dxc->approval_ke = 10;
					$dxc->status = 'A';
					$dxc->internal_pend = 0;
					$dxc->approved_by = $cekapp->appv10;
					$dxc->save();
					
					$emailx = User::where('id',$cekapp->appv10)->pluck('email');
			
					if(get_option('assign_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'assign';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new AssignMail($mail));
					}
				}
				else if($status == 2)
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'D';
					$dokumen->internal_pend = 0;
					$dokumen->save();
				}
				else
				{
					$dokumen = Claim::find($id);
					$dokumen->status = 'P';
					$dokumen->internal_pend = $inped;
					$dokumen->save();
				}
			}
			
			$approval = ClaimApproval::where('claim_id',$id)->first();
			$approval->status9 = $status;
			$approval->approved_9 = $EmployeeId;
			$approval->note_appv9 = $ApprovalNote;
			$approval->approved_9_date = now();
			
			$approval->save();
		 }
		 //end tamabahan
		 
		 else
		 {
				 if($status == 1)
				 {
					$now = now();
					$year = $now->year;
					$yeari = substr($year, -2);
					$bulan = $now->month;
					
					$month = str_pad($bulan, 2, "0", STR_PAD_LEFT);
					$maxReqNo = Claim::selectRaw("case
										when coalesce(max(right(`nomor`, 4)), 0)+1 = 10000 then 1
										else coalesce(max(right(`nomor`, 4)), 0)+1
										end as maxID")
										->where('nomor','like', '%' . $yeari.$month . '%')
										->get();
										
					$costcode = CostCenter::selectRaw("cost_code")
							->where('id',$cost)
							->first();
		
					$ReqNo = $costcode->cost_code.$yeari.$month.sprintf('%04s', $maxReqNo[0]->maxID);
					
						$dokumen = Claim::find($id);
						$dokumen->nomor = $ReqNo;
						$dokumen->status = 'B';
						$dokumen->internal_pend = 0;
						$dokumen->approved_by = NULL;
						$dokumen->save();
				 }
				 
				 else if($status == 2)
				 {
						$dokumen = Claim::find($id);
						$dokumen->status = 'D';
						$dokumen->internal_pend = 0;
						$dokumen->save();
				}
				else
				{
						$dokumen = Claim::find($id);
						$dokumen->status = 'P';
						$dokumen->internal_pend = $inped;
						$dokumen->save();	
				}
				
				$approval = ClaimApproval::where('claim_id',$id)->first();
				$approval->status10 = $status;
				$approval->approved_10 = $EmployeeId;
				$approval->note_appv10 = $ApprovalNote;
				$approval->approved_10_date = now();
				
				$approval->save();
		 }
		 
		if(! $request->ajax()){
           return redirect('approval')->with('success', _lang('Approved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Approved Sucessfully'),'data'=>$claim]);
		}
		 
		
    }
	
	public function fa_approved(request $request){
        $idx = $request->input('claim_id');
        $ApprovalNote = $request->input('ApprovalNote');
        $status = $request->input('ApprovalSts');
		$EmployeeId = \Auth::user()->id;
		
		//echo $idx;
		//die;
		
			$app = ClaimApproval::where('claim_id',$idx)->first();
			$app->status_finance = $status;
			$app->finance_appv = $EmployeeId;
			$app->note_finance = $ApprovalNote;
			$app->finance_appv_date = now();
				
			$app->save();
			
			if($status == 1)
			{
				$x = "B";
				$flag = 4;
			}
			elseif($status == 3)
			{
				$x = "F";
				$flag = 6;
				$pdate = date("Y-m-d"); 
			}
			else
			{ 
				$x = "D";
				$flag = 4;				
			}
			
			$calim = Claim::find($idx);
			$calim->dpp = str_replace(',','', $request->input('tot_dpp'));
			$calim->ppn = str_replace(',','', $request->input('tot_ppn'));
			$calim->pph = str_replace(',','', $request->input('tot_pph'));
			$calim->status = $x;
			if($status == 3)
			{
				$calim->pay_date = $pdate;
			}
			$calim->flag_acc = $flag;
			$calim->save();
			
			
			/* perubahan codingan 08/08/2023 /// 
			 $periode = $request->input('produk_id', []);
			 $nilai =  str_replace(',','', $request->input('nilai', []));
			 $qty =  str_replace(',','', $request->input('qty', []));
			 $satuan =  $request->input('satuan', []);
			 $dpp =  str_replace(',','', $request->input('dpp', []));

			
			 for ($period=0; $period < count($periode); $period++) {
						if ($periode[$period] != '') 
						{
							//$produk = new ClaimProduk();
							
							$produk = ClaimProduk::where('claim_id',$idx)->where('produk_id',$periode[$period])->first();
							$produk->qty = $qty[$period];
							$produk->nilai = $nilai[$period];
							$produk->satuan = $satuan[$period];
							$produk->dpp = $dpp[$period];
							$produk->save();
						}
					}
			*/	
		     $sp = ClaimProduk::where('claim_id',$idx);
			 $sp->delete();
			
			 $periode = $request->input('produk_id', []);
			 $nilai =  str_replace(',','', $request->input('nilai', []));
			 $qty =  str_replace(',','', $request->input('qty', []));
			 $satuan =  $request->input('satuan', []);
			 $dpp =  str_replace(',','', $request->input('dpp', []));
			 
			 
			 for ($period=0; $period < count($periode); $period++) {
						if ($periode[$period] != '') 
						{
							$produk = new ClaimProduk();
	  
							$produk->claim_id = $idx;
							$produk->produk_id = $periode[$period];
							$produk->qty = $qty[$period];
							$produk->nilai = $nilai[$period];
							$produk->satuan = $satuan[$period];
							$produk->dpp = $dpp[$period];
							$produk->save();
						}
					}
			
			
			$idd = Claim::where('id',$idx)->get();
			foreach ($idd as $idy)
			{
				$di = $idy->distributor_id;
			}
					
		   if($status == 3)
			{
					$emailx = User::where('distri_id',$di)->pluck('email');
					if(get_option('manager_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'manager';
						$mail->id = $idx;
						$mail->subject = 'E-Klaim ID - '.$idx;
						\Mail::to($emailx)->send(new ManagerMail($mail));
					}
			}
			
		 
		if(! $request->ajax()){
           return redirect('finance_approval')->with('success', _lang('Approved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Approved Sucessfully'),'data'=>$claim]);
		}
		 
		
    }
	
	public function acc_approved(request $request){
        
		$id = $request->input('claim_id');
        $ApprovalNote = $request->input('ApprovalNote');
        $status = $request->input('ApprovalSts');
		$EmployeeId = \Auth::user()->id;
		
			$app = ClaimApproval::where('claim_id',$id)->first();
			$app->status_acc = $status;
			$app->acc_appv = $EmployeeId;
			$app->note_acc = $ApprovalNote;
			$app->acc_appv_date = now();
				
			$app->save();
			
			if($status == 1)
			{
				$apx = Claim::where('id',$id)->first();
				$apx->flag_acc = 6;
				$apx->status = 'C';
				$apx->pay_date = $request->input('pay_date');
				$apx->save();
			}
			else
			{
				$apx = Claim::where('id',$id)->first();
				$apx->flag_acc = 6;
				$apx->status = 'T';
				$apx->save();
				
			}
			
			$idd = Claim::where('id',$id)->get();
			foreach ($idd as $idx)
			{
				$di = $idx->distributor_id;
			}
			
			
			$emailx = User::where('distri_id',$di)->pluck('email');
					//echo $emailx;
					//die;
					
					if(get_option('manager_status') == 1){
						Overrider::load("Settings");
						$mail  = new \stdClass();
						$mail->template_name = 'manager';
						$mail->id = $id;
						$mail->subject = 'E-Klaim ID - '.$id;
						\Mail::to($emailx)->send(new ManagerMail($mail));
					}
		 
		if(! $request->ajax()){
           return redirect('acc_approval')->with('success', _lang('Approved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Approved Sucessfully'),'data'=>$claim]);
		}
		 
		
    }
	
	public function simpan_konfirm_acc(Request $request, $id)
    {
        
		$status = $request->input('status_terima_acc');
		
		if($status == 1)
		{
			$validator = Validator::make($request->all(), [
				'tanggal_terima_acc' => 'required',
			]);
			
			if ($validator->fails()) {
				if($request->ajax()){ 
					return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
				}else{
					return redirect('approval/viewfat')
								->withErrors($validator)
								->withInput();
				}			
			}
		
		
		
		
			$claim = Claim::find($id);
			$claim->flag_acc = 3;
			$claim->status = 'B';
			$claim->save();
		}
		else
		{
			$claim = Claim::find($id);
			$claim->status = 'P';
			$claim->save();
		}
		
		$xcol = ClaimFlowDokumen::where('claim_id',$id)->first();
		$xcol->tanggal_terima_acc = $request->input('tanggal_terima_acc');
		$xcol->acc_terima = \Auth::user()->id;
		$xcol->acc_pending = now();
		$xcol->status_terima_acc = $status;
		$xcol->note_balik_acc = $request->input('note_balik_acc');
		$xcol->save();
	
        
		if(! $request->ajax()){
           return redirect('finance_approval')->with('success', _lang('Confirmed Sucessfully'));
        }else{
		   return response()->json(['result'=>'success', 'redirect' => url('finance_approval') ,'message'=>_lang('Confirmed Sucessfully')]);
		}
        
        
    }
	
	public function simpan_konfirm_fat(Request $request, $id)
    {
        
        
		$status = $request->input('status_terima_fat');
		
		if($status == 1)
		{
			$validator = Validator::make($request->all(), [
				'tanggal_terima_fat' => 'required',
			]);
		
			if ($validator->fails()) {
				if($request->ajax()){ 
					return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
				}else{
					return redirect('approval/viewacc')
								->withErrors($validator)
								->withInput();
				}			
			}
		
		
		
		
			$claim = Claim::find($id);
			$claim->flag_acc = 5;
			$claim->status = 'B';
			$claim->save();
		}
		else
		{
			$claim = Claim::find($id);
			$claim->status = 'P';
			$claim->save();
		}
		
		$xcol = ClaimFlowDokumen::where('claim_id',$id)->first();
		$xcol->tanggal_terima_fat = $request->input('tanggal_terima_fat');
		$xcol->fat_pending = now();
		$xcol->fat_terima = \Auth::user()->id;
		$xcol->status_terima_fat = $status;
		$xcol->note_balik_fat = $request->input('note_balik_fat');
		$xcol->save();
	
        
		if(! $request->ajax()){
           return redirect('acc_approval')->with('success', _lang('Confirmed Sucessfully'));
        }else{
		   return response()->json(['result'=>'success', 'redirect' => url('acc_approval') ,'message'=>_lang('Confirmed Sucessfully')]);
		}
        
        
    }
	
	public function simpan_validasi_acc(Request $request, $id)
    {
        
			$calim = Claim::find($id);
			$calim->nominal = str_replace(',','', $request->input('nominal'));
			$calim->dpp = str_replace(',','', $request->input('tot_dpp'));
			$calim->ppn = str_replace(',','', $request->input('tot_ppn'));
			$calim->pph = str_replace(',','', $request->input('tot_pph'));
			$calim->save();
			
			 $sp = ClaimProduk::where('claim_id',$id);
			 $sp->delete();
			
			 $periode = $request->input('produk_id', []);
			 $nilai =  str_replace(',','', $request->input('nilai', []));
			 $qty =  str_replace(',','', $request->input('qty', []));
			 $satuan =  $request->input('satuan', []);
			 $dpp =  str_replace(',','', $request->input('dpp', []));

			
			 for ($period=0; $period < count($periode); $period++) {
						if ($periode[$period] != '') 
						{
							$produk = new ClaimProduk();
	  
							$produk->claim_id = $id;
							$produk->produk_id = $periode[$period];
							$produk->qty = $qty[$period];
							$produk->nilai = $nilai[$period];
							$produk->satuan = $satuan[$period];
							$produk->dpp = $dpp[$period];
							$produk->save();
						}
					}
			
			 //$idx = $request->input('idx');
			 //$pid = $request->input('produk_id');
			 //$nilai =  str_replace(',','', $request->input('nilai'));
			 //$qty =  str_replace(',','', $request->input('qty'));
			 //$satuan =  $request->input('satuan');
			// $dpp =  str_replace(',','', $request->input('dpp'));
			 
			 // perubahan codingan 08/08/2023 //
			 
			 //$spx = ClaimProduk::where('id',$idx)->where('claim_id',$id)->where('produk_id',$pid);
			 //$spx->qty = $qty;
			 //$spx->nilai = $nilai;
			 //$spx->satuan = $satuan;
			 //$spx->dpp = $dpp;
			 //$spx->save();
			 

	  		/*
			 $periode = $request->input('produk_id', []);
			 $nilai =  str_replace(',','', $request->input('nilai', []));
			 $qty =  str_replace(',','', $request->input('qty', []));
			 $satuan =  $request->input('satuan', []);
			 $dpp =  str_replace(',','', $request->input('dpp', []));

			
			 for ($period=0; $period < count($periode); $period++) {
						if ($periode[$period] != '') 
						{
							//$produk = new ClaimProduk();
							
							$produk = ClaimProduk::where('claim_id',$id)->where('produk_id',$periode[$period])->first();
	  
							//$produk->claim_id = $id;
							//$produk->produk_id = $periode[$period];
							$produk->qty = $qty[$period];
							$produk->nilai = $nilai[$period];
							$produk->satuan = $satuan[$period];
							$produk->dpp = $dpp[$period];
							$produk->save();
						}
					} */
		
        
		if(! $request->ajax()){
           return redirect('finance_approval')->with('success', _lang('Validation Sucessfully'));
        }else{
		   return response()->json(['result'=>'success', 'redirect' => url('finance_approval') ,'message'=>_lang('Validation Sucessfully')]);
		}
        
        
    }

    
}
