<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\User;
use App\UserAkses;
use App\CostCenter;
use App\VCostCenter;
use App\BulkPembayaran;
use App\ClaimApproval;
use App\Distributor;
use App\Dokumen;
use App\Mail\DefaultMail;
use App\Mail\AdminMail;
use App\Mail\AssignMail;
use App\Mail\ManagerMail;
use App\Produk;
use Auth;
use App\ListDocument;
use Validator;
use PDF;
use App\Utilities\Overrider;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BulkPembayaranController extends Controller
{
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
		$idx = Auth::user()->distri_id;
		$type = Auth::user()->user_type;
		$uid = Auth::user()->id;

		$claim = BulkPembayaran::all()->sortByDesc("id");

		return view('backend.bulkpembayaran.list', compact('claim'));
	}

	public function create(Request $request)
	{
		$claim = Claim::where('status', '!=', 'D')->where('flag_acc', 4)->orwhere('flag_acc', 5)->get();

		if (!$request->ajax()) {
			return view('backend.bulkpembayaran.create', compact('claim'));
		} else {
			return view('backend.bulkpembayaran.modal.create', compact('claim'));
		}
	}


	public function store(Request $request)
	{
		$type = Auth::user()->user_type;
		$uid = Auth::user()->id;
		$tanggal = $request->input('pay_date');
		$status =  $request->input('ApprovalSts');


		if (!$request->has('ids')) {
			return redirect()->back()->with('alert', [
				'type' => 'danger',
				'msg' => 'Silahkan pilih data',
			]);
		}

		$bulk = new BulkPembayaran();
		$bulk->jenis_bulk = $type;
		$bulk->created_by = \Auth::user()->id;
		$bulk->save();

		if ($status == 1) {
			$X = 'C';
		} else {
			$X = 'T';
			$tanggal = null;
		}
		Claim::whereIn('id', $request->ids)->update([
			'bulk_id' => $bulk->id,
			'flag_acc' => 6,
			'status' => $X,
			'pay_date' => $tanggal,
		]);

		$idx = $request->input('ids', []);
		$idd = $request->input('idd', []);
		$note = $request->input('ApprovalNote', []);
		$noted = $request->input('ApprovalNotes');

		// dump($note, $noted);

		for ($i = 0; $i < count($idx); $i++) {
			if ($idx[$i] != '') {
				$app = ClaimApproval::where('claim_id', $idx[$i])->first();
				$app->status_acc = $status;
				$app->acc_appv = $uid;
				if (empty($noted)) {
					$notex = $note[$i];
				} else {
					$notex = $noted;
				}
				$app->note_acc = $notex;
				$app->acc_appv_date = now();
				$app->bulk_id = $bulk->id;
				$app->save();
			}
		}
		$idm = Claim::whereIn('id', $request->ids)->get();
		foreach ($idm as $idx) {
			$di = $idx->distributor_id;
			$idy = $idx->id;

			$emailx = User::where('distri_id', $di)->pluck('email');

			if (get_option('manager_status') == 1) {
				Overrider::load("Settings");
				$mail  = new \stdClass();
				$mail->template_name = 'manager';
				$mail->id = $idy;
				$mail->subject = 'E-Klaim ID - ' . $idy;
				\Mail::to($emailx)->send(new ManagerMail($mail));
			}
		}

		if (!$request->ajax()) {
			return redirect('bulkpembayaran')->with('success', _lang('Saved Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Sucessfully'), 'data' => $claim]);
		}
	}

	public function show(Request $request, $id)
	{
		$spr = BulkPembayaran::find($id);
		$app = ClaimApproval::where('bulk_id', $id)->get();
		$appz = Claim::where('bulk_id', $id)->get();


		if (!$request->ajax()) {
			return view('backend.bulkpembayaran.view', compact('spr', 'id', 'app', 'appz'));
		} else {
			return view('backend.bulkpembayaran.modal.view', compact('spr', 'id', 'app', 'appz'));
		}
	}

	public function edit(Request $request, $id)
	{
		$spr = Claim::find($id);
		$products = Produk::where('status', '=', 1)
			->get();
		$dokumen = Dokumen::where('status', '=', 1)->get();

		$inserted_fac = DB::select(DB::raw(
			"SELECT d.id, d.name, d.status, cd.nama_document, cd.claim_id  
							from eklaim.dokumen d
							LEFT JOIN eklaim.claim_dokument cd 
							ON d.id = cd.document_id and cd.claim_id = $id"
		));

		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->where('claim_produk.claim_id', $id)
			->get();

		if (!$request->ajax()) {
			return view('backend.claim.edit', compact('spr', 'id', 'dokumen', 'produk', 'products', 'inserted_fac'));
		} else {
			return view('backend.claim.modal.edit', compact('spr', 'id', 'dokumen', 'produk', 'products', 'inserted_fac'));
		}
	}

	public function update(Request $request, $id)
	{

		$validator = Validator::make($request->all(), [
			'promo_id' => 'required',
			'distributor_id' => 'required',
			'nominal' => 'required',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect('claim/edit')
					->withErrors($validator)
					->withInput();
			}
		}

		$appv = CostCenter::selectRaw("appv1")
			->where('id', $request->input('cost_id'))
			->first();

		if (empty($appv)) {
			$app = 1;
		} else {
			$app = $appv->appv1;
		}

		$claim = Claim::find($id);
		$claim->distributor_id = $request->input('distributor_id');
		$claim->category_id = $request->input('category_id');
		$claim->promo_id = $request->input('promo_id');
		$claim->promo_idx = $request->input('promo_idx');
		$claim->judul_email = $request->input('judul_email');
		$claim->periode_start = $request->input('periode_start');
		$claim->periode_end = $request->input('periode_end');
		$claim->payment_method = $request->input('payment_method');
		$claim->note_admin_lagi = $request->input('note_admin_lagi');
		$claim->surat_jalan = $request->input('surat_jalan');
		$claim->no_surat = $request->input('no_surat');
		$claim->region_id = $request->input('region_id');
		$claim->nominal = str_replace(',', '', $request->input('nominal'));
		$claim->bank_id = $request->input('bank_id');
		$claim->no_rek = str_replace(',', '', $request->input('no_rek'));
		$claim->nama_rek = $request->input('nama_rek');
		$claim->cost_id = $request->input('cost_id');
		$claim->created_by = \Auth::user()->id;
		$claim->approved_by = $app;
		$claim->save();



		$sp = ClaimProduk::where('claim_id', $claim->id);
		$sp->delete();

		$periode = $request->input('produk_id', []);
		$nilai =  str_replace(',', '', $request->input('nilai', []));
		$qty =  str_replace(',', '', $request->input('qty', []));
		$satuan =  $request->input('satuan', []);

		for ($period = 0; $period < count($periode); $period++) {
			if ($periode[$period] != '') {
				$produk = new ClaimProduk();

				$produk->claim_id = $claim->id;
				$produk->produk_id = $periode[$period];
				$produk->qty = $qty[$period];
				$produk->nilai = $nilai[$period];
				$produk->satuan = $satuan[$period];

				$produk->save();
			}
		}

		$sx = ClaimDokumen::where('claim_id', $claim->id);
		$sx->delete();

		$dokumen = $request->input('document_id', []);
		$ndokumen = $request->input('nama_document', []);

		if (!empty($dokumen)) {
			for ($document = 0; $document < count($dokumen); $document++) {
				if ($dokumen[$document] != '') {
					$dokument = new ClaimDokumen();

					$dokument->claim_id = $claim->id;
					$dokument->document_id = $dokumen[$document];
					$dokument->nama_document = $ndokumen[$document];

					$dokument->save();
				}
			}
		}


		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Updated Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Updated Sucessfully'), 'data' => $claim]);
		}
	}

	public function update_cc(Request $request, $id)
	{

		$validator = Validator::make($request->all(), [
			'promo_id' => 'required',
			'cost_id' => 'required',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect('claim/view')
					->withErrors($validator)
					->withInput();
			}
		}

		$appv = CostCenter::selectRaw("appv1")
			->where('id', $request->input('cost_id'))
			->first();

		if (empty($appv)) {
			$app = 1;
		} else {
			$app = $appv->appv1;
		}

		$now = now();

		$claim = Claim::find($id);

		$claim->promo_id = $request->input('promo_id');
		$claim->cost_id = $request->input('cost_id');
		$claim->note_perubahan = $request->input('note_perubahan');
		$claim->flag_acc = 1;
		$claim->status = 'A';
		$claim->updated_by = \Auth::user()->id;
		$claim->admin_date = $now;
		$claim->approved_by = $app;
		$claim->save();


		$emailx = User::where('id', $app)->pluck('email');

		if (get_option('assign_status') == 1) {
			Overrider::load("Settings");
			$mail  = new \stdClass();
			$mail->template_name = 'assign';
			$mail->id = $claim->id;
			$mail->subject = 'E-Klaim ID - ' . $claim->id;
			\Mail::to($emailx)->send(new AssignMail($mail));
		}


		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Confirmed Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'redirect' => url('claim'), 'message' => _lang('Confirmed Sucessfully')]);
		}
	}

	public function simpan_acc(Request $request, $id)
	{

		$validator = Validator::make($request->all(), [
			'tanggal_kirim_acc' => 'required',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect('claim/view')
					->withErrors($validator)
					->withInput();
			}
		}

		$claim = Claim::find($id);
		$claim->flag_acc = 2;
		$claim->status = 'B';
		$claim->save();

		$xcol = ClaimFlowDokumen::where('claim_id', $id)->first();
		$xcol->tanggal_kirim_acc = $request->input('tanggal_kirim_acc');
		$xcol->admin_kirim = \Auth::user()->id;
		//$xcol->note_kirim_acc = $request->input('note_kirim_acc');
		$xcol->save();



		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Confirmed Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'redirect' => url('claim'), 'message' => _lang('Confirmed Sucessfully')]);
		}
	}

	public function simpan_fat(Request $request, $id)
	{

		$validator = Validator::make($request->all(), [
			'tanggal_kirim_fat' => 'required',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect('claim/view')
					->withErrors($validator)
					->withInput();
			}
		}

		$claim = Claim::find($id);
		$claim->flag_acc = 4;
		$claim->save();

		$xcol = ClaimFlowDokumen::where('claim_id', $id)->first();
		$xcol->tanggal_kirim_fat = $request->input('tanggal_kirim_fat');
		$xcol->acc_kirim = \Auth::user()->id;
		$xcol->save();


		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Confirmed Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'redirect' => url('claim'), 'message' => _lang('Confirmed Sucessfully')]);
		}
	}
}
