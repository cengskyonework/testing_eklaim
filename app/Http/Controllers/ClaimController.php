<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\ClaimNote;
use App\User;
use App\UserAkses;
use App\CostCenter;
use App\VCostCenter;
use App\ClaimProduk;
use App\ClaimDokumen;
use App\ClaimFlowDokumen;
use App\ClaimApproval;
use App\Distributor;
use App\Dokumen;
use App\Mail\DefaultMail;
use App\Mail\AdminMail;
use App\Mail\AssignMail;
use App\Produk;
use App\Promo;
use Auth;
use App\ListDocument;
use Validator;
use PDF;
use App\Utilities\Overrider;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
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

		// ini_set('memory_limit', '512M');

		if ($type == 'user') {
			$app = ClaimApproval::all();
			$claim = Claim::where('distributor_id', '=', $idx)->get();
		} else if ($type == 'manager') {
			$count = DB::table('user_akses')->where('user_id', $uid)->count();

			if ($count > 0) {
				$app = ClaimApproval::all();
				$ada =  DB::table('user_akses')->select('cost_id')->where('user_id', $uid);

				$cekin = ['N', 'A'];

				$claim = Claim::whereNotIn('status', $cekin)->whereIn('cost_id', $ada)->get();
			} else {
				$app = ClaimApproval::all();
				$claim = Claim::where('status', '=', 'X')->get();
			}
		} else {
			$app = ClaimApproval::all();
			// $claim = Claim::latest('id')->select('id', 'surat_jalan', 'nomor', 'distributor_id', 'category_id', 'promo_idx', 'promo_id', 'region_id', 'cost_id', 'status', 'created_at', 'no_ap', 'internal_pend', 'nominal', 'ppn', 'pph', 'dpp')->get();
			$claim = Claim::latest('id')->select('id', 'surat_jalan', 'nomor', 'distributor_id', 'category_id', 'promo_idx', 'promo_id', 'region_id', 'cost_id', 'status', 'created_at', 'no_ap', 'internal_pend', 'nominal', 'ppn', 'pph', 'dpp')->paginate(100);
		}
		return view('backend.claim.list', compact('claim', 'app'));
	}

	public function create(Request $request)
	{
		$dokumen = Dokumen::where('status', '=', 1)
			->get();
		$products =  DB::table('v_produk')->where('status', '=', 1)
			->get();

		if (!$request->ajax()) {
			return view('backend.claim.create', compact('dokumen', 'products'));
		} else {
			return view('backend.claim.modal.create', compact('dokumen', 'products'));
		}
	}

	public function create_acc(Request $request, $id)
	{
		$transaktions = Claim::find($id);
		if (!$request->ajax()) {
			return view('backend.claim.create', compact('transaktions', 'id'));
		} else {
			return view('backend.claim.modal.create', compact('transaktions', 'id'));
		}
	}

	public function edit_cc(Request $request, $id)
	{
		$transaktions = Claim::find($id);

		if (!$request->ajax()) {
			return view('backend.claim.edit_cc', compact('transaktions', 'id'));
		} else {
			return view('backend.claim.modal.edit_cc', compact('transaktions', 'id'));
		}
	}

	public function edit_apv(Request $request, $id)
	{
		$transaktions = Claim::find($id);

		if (!$request->ajax()) {
			return view('backend.claim.edit_apv', compact('transaktions', 'id'));
		} else {
			return view('backend.claim.modal.edit_apv', compact('transaktions', 'id'));
		}
	}

	public function edit_acc(Request $request, $id)
	{
		$transaktions = Claim::find($id);
		$appx = ClaimFlowDokumen::where('claim_id', $id)->get();
		if (!$request->ajax()) {
			return view('backend.claim.edit', compact('transaktions', 'appx', 'id'));
		} else {
			return view('backend.claim.modal.edit', compact('transaktions', 'appx', 'id'));
		}
	}

	public function edit_fat(Request $request, $id)
	{
		$transaktions = Claim::find($id);
		$appx = ClaimFlowDokumen::where('claim_id', $id)->get();
		if (!$request->ajax()) {
			return view('backend.claim.edit_fat', compact('transaktions', 'appx', 'id'));
		} else {
			return view('backend.claim.modal.edit_fat', compact('transaktions', 'appx', 'id'));
		}
	}

	public function input_ap(Request $request, $id)
	{
		$transaktions = Claim::find($id);
		if (!$request->ajax()) {
			return view('backend.claim.input', compact('transaktions', 'id'));
		} else {
			return view('backend.claim.modal.input', compact('transaktions', 'id'));
		}
	}

	public function createx(Request $request)
	{
		$dokumen = Dokumen::where('status', '=', 1)
			->get();
		$products =  DB::table('v_produk')->where('status', '=', 1)
			->get();
		$ditributor = Distributor::where('id', '=', Auth::user()->distri_id)->get();

		// if (!$request->ajax()) {
		// 	return view('backend.claim.create_direct', compact('ditributor', 'dokumen', 'products'));
		// } else {
		// 	return view('backend.claim.modal.create_direct', compact('ditributor', 'dokumen', 'products'));
		// }

		if (!$request->ajax()) {
			return view('backend.claim.create', compact('ditributor', 'dokumen', 'products'));
		} else {
			return view('backend.claim.modal.create', compact('ditributor', 'dokumen', 'products'));
		}
	}

	public function get_data_konsumen(Request $request)
	{
		$Distributor = Distributor::find($request->id);

		return response()->json([
			'status' => 'success',
			'address' =>  $Distributor->address,
			'id_no' =>  $Distributor->id_no,
			'npwp' =>  $Distributor->npwp,
			'hp' =>  $Distributor->hp,
			'email' =>  $Distributor->email,
			'bank_id' =>  $Distributor->bank_id,
			'nama_rek' =>  $Distributor->nama_rek,
			'no_rek' =>  $Distributor->no_rek,
		], 200);
	}

	public function get_data_chanel(Request $request)
	{
		$cost_id = DB::table('v_costcenter2')->where('chanel_id', $request->id)->pluck('name', 'id');
		return response()->json($cost_id);
	}

	public function get_data_produk(Request $request)
	{
		$product_id = DB::table('v_produk')->where('cat_claim', $request->id)->pluck('nama', 'id');
		return response()->json($product_id);
	}

	public function get_data_promo(Request $request)
	{
		$promo = Promo::find($request->id);

		return response()->json([
			'status' => 'success',
			'wilayah' =>  $promo->wilayah,
		], 200);
	}

	public function store(Request $request)
	{
		$type = Auth::user()->user_type;

		if ($type == 'user') {
			$validator = Validator::make($request->all(), [
				'nominal' => 'required',
			]);
		} else {
			$validator = Validator::make($request->all(), [
				'distributor_id' => 'required',
				'nominal' => 'required',
			]);
		}

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect('claim/create')
					->withErrors($validator)
					->withInput();
			}
		}

		$image = '';
		if ($request->hasfile('image')) {
			$file = $request->file('image');
			$image = time() . $file->getClientOriginalName();
			$file->move(public_path() . "/uploads/media/", $image);
		}

		$appv = CostCenter::where('id', $request->input('cost_id'))
			->first();

		if (empty($appv)) {
			$app = 1;
		} else {
			$app = $appv->appv1;
		}





		$claim = new Claim();
		$claim->distributor_id = $request->input('distributor_id');
		$claim->category_id = $request->input('category_id');

		if ($type == 'user') {
			$claim->cost_id = 103;
			$claim->promo_id = 47;
		} else {
			$claim->cost_id = $request->input('cost_id');
			$claim->promo_id = $appv->chanel_id;
		}

		$claim->promo_idx = $request->input('promo_idx');
		$claim->judul_email = $request->input('judul_email');
		$claim->periode_start = $request->input('periode_start');
		$claim->periode_end = $request->input('periode_end');
		$claim->payment_method = $request->input('payment_method');
		$claim->surat_jalan = $request->input('surat_jalan');
		$claim->no_surat = $request->input('no_surat');
		$claim->region_id = $request->input('region_id');
		$claim->nominal = str_replace(',', '', $request->input('nominal'));
		$claim->bank_id = $request->input('bank_id');
		$claim->no_rek = str_replace(',', '', $request->input('no_rek'));
		$claim->nama_rek = $request->input('nama_rek');
		$claim->nama_document = $request->input('nama_document');
		$claim->created_by = \Auth::user()->id;
		$claim->approved_by = $app;
		$claim->save();

		$di = $request->input('distributor_id');
		$distri = Distributor::find($di);
		$distri->hp = $request->input('hp');
		$distri->save();

		$approval = new ClaimApproval();
		$approval->claim_id = $claim->id;
		$approval->save();

		$history = new ClaimFlowDokumen();
		$history->claim_id = $claim->id;
		$history->save();


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
				$produk->satuan = $satuan[$period];
				$produk->nilai = $nilai[$period];

				$produk->save();
			}
		}

		$dokumen = $request->input('document_id', []);
		//$ndokumen = $request->input('nama_document', []);

		if (!empty($dokumen)) {
			for ($document = 0; $document < count($dokumen); $document++) {
				if ($dokumen[$document] != '') {
					$dokument = new ClaimDokumen();

					$dokument->claim_id = $claim->id;
					$dokument->document_id = $dokumen[$document];
					$dokument->save();
				}
			}
		}

		$idm = $request->input('distributor_id');
		$email = User::where('distri_id', $idm)->pluck('email');

		$admmail = User::where('user_type', '=', 'administrator')->pluck('email');

		$id = $claim->id;

		if (get_option('ticket_open_status') == 1) {
			Overrider::load("Settings");
			$mail  = new \stdClass();
			$mail->template_name = 'ticket_open';
			$mail->id = $claim->id;
			$mail->subject = 'E-Claim Distributor PT. Niramas Utama';
			\Mail::to($email)->send(new DefaultMail($mail));
		}

		if (get_option('ticket_response_status') == 1) {
			Overrider::load("Settings");
			$mail  = new \stdClass();
			$mail->template_name = 'ticket_response';
			$mail->id = $claim->id;
			$mail->subject = 'E-Claim Distributor PT. Niramas Utama';
			\Mail::to($admmail)->send(new AdminMail($mail));
		}



		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Saved Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Sucessfully'), 'data' => $claim]);
		}
	}

	public function show(Request $request, $id)
	{
		$spr = Claim::find($id);
		$notes = ClaimNote::where('claim_id', $id)->get();
		$app = ClaimApproval::where('claim_id', $id)->get();
		$appz = ClaimFlowDokumen::where('claim_id', $id)->get();
		$dokumen = ClaimDokumen::select([
			"claim_dokument.id as id",
			"claim_dokument.*",
			"dokumen.name AS name",
		])
			->join('dokumen', 'dokumen.id', 'document_id')
			->where('claim_dokument.claim_id', $id)
			->get();

		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->where('claim_produk.claim_id', $id)
			->get();

		if (!$request->ajax()) {
			return view('backend.claim.view', compact('spr', 'id', 'dokumen', 'produk', 'app', 'appz', 'notes'));
		} else {
			return view('backend.claim.modal.view', compact('spr', 'id', 'dokumen', 'produk', 'app', 'appz', 'notes'));
		}
	}

	public function edit(Request $request, $id)
	{
		$spr = Claim::find($id);
		$notes = ClaimNote::where('claim_id', $id)->get();
		$products = DB::table('v_produk')->where('status', '=', 1)
			->get();
		$dokumen = Dokumen::where('status', '=', 1)->get();

		//$inserted_fac = DB::select(DB::raw("SELECT d.id, d.name, d.status, cd.nama_document, cd.claim_id  
		//from eklaim.dokumen d
		//LEFT JOIN eklaim.claim_dokument cd 
		//ON d.id = cd.document_id and cd.claim_id = $id"
		//));

		$inserted_fac = ClaimDokumen::where('claim_id', $id)->get();


		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->where('claim_produk.claim_id', $id)
			->get();

		if (!$request->ajax()) {
			return view('backend.claim.edit', compact('spr', 'id', 'dokumen', 'produk', 'products', 'inserted_fac', 'notes'));
		} else {
			return view('backend.claim.modal.edit', compact('spr', 'id', 'dokumen', 'produk', 'products', 'inserted_fac', 'notes'));
		}
	}

	public function update(Request $request, $id)
	{

		$validator = Validator::make($request->all(), [
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

		$appv = CostCenter::where('id', $request->input('cost_id'))
			->first();

		if (empty($appv)) {
			$app = 1;
		} else {
			$app = $appv->appv1;
		}

		$claim = Claim::find($id);
		$claim->distributor_id = $request->input('distributor_id');
		$claim->category_id = $request->input('category_id');
		$claim->promo_id = $appv->chanel_id;
		$claim->promo_idx = $request->input('promo_idx');
		$claim->judul_email = $request->input('judul_email');
		$claim->periode_start = $request->input('periode_start');
		$claim->periode_end = $request->input('periode_end');
		$claim->payment_method = $request->input('payment_method');
		$claim->note_admin_lagi = $request->input('claim_admin_note');
		$claim->surat_jalan = $request->input('surat_jalan');
		$claim->no_surat = $request->input('no_surat');
		$claim->region_id = $request->input('region_id');
		$claim->nominal = str_replace(',', '', $request->input('nominal'));
		$claim->bank_id = $request->input('bank_id');
		$claim->no_rek = str_replace(',', '', $request->input('no_rek'));
		$claim->nama_rek = $request->input('nama_rek');
		$claim->nama_document = $request->input('nama_document');
		$claim->cost_id = $request->input('cost_id');
		//$claim->created_by = \Auth::user()->id;
		//$claim->approved_by = $app;
		$claim->save();


		$notes = $request->input('claim_admin_note');

		if ($notes != '') {
			$notesan = new ClaimNote();
			$notesan->claim_id = $claim->id;
			$notesan->claim_admin_note = $notes;
			$notesan->created_by = \Auth::user()->id;;
			$notesan->save();
		}


		$sp = ClaimProduk::where('claim_id', $id);
		$sp->delete();

		$periode = $request->input('produk_id', []);
		$nilai =  str_replace(',', '', $request->input('nilai', []));
		$qty =  str_replace(',', '', $request->input('qty', []));
		$satuan =  $request->input('satuan', []);

		for ($period = 0; $period < count($periode); $period++) {
			if ($periode[$period] != '') {
				$produk = new ClaimProduk();

				$produk->claim_id = $id;
				$produk->produk_id = $periode[$period];
				$produk->qty = $qty[$period];
				$produk->nilai = $nilai[$period];
				$produk->satuan = $satuan[$period];

				$produk->save();
			}
		}

		$sx = ClaimDokumen::where('claim_id', $id);
		$sx->delete();

		$dokumen = $request->input('document_id', []);
		$ndokumen = $request->input('nama_document', []);

		if (!empty($dokumen)) {
			for ($document = 0; $document < count($dokumen); $document++) {
				if ($dokumen[$document] != '') {
					$dokument = new ClaimDokumen();

					$dokument->claim_id = $id;
					$dokument->document_id = $dokumen[$document];
					$dokument->save();
				}
			}
		}


		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Updated Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'redirect' => url('claim'), 'message' => _lang('Updated Sucessfully')]);
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

	public function update_apv(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'approved_by' => 'required',
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
		$claim->approved_by = $request->input('approved_by');
		$claim->save();


		$emailx = User::where('id', $request->input('approved_by'))->pluck('email');

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


	public function simpan_ap(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'no_ap' => 'required',
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
		$claim->no_ap = $request->input('no_ap');
		$claim->save();

		if (!$request->ajax()) {
			return redirect('claim')->with('success', _lang('Submit Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'redirect' => url('claim'), 'message' => _lang('Submit Sucessfully')]);
		}
	}



	public function cetak($id)
	{
		$spr = Claim::find($id);
		$app = ClaimApproval::where('claim_id', $id)->get();
		$appz = ClaimFlowDokumen::where('claim_id', $id)->get();
		$dokumen = ClaimDokumen::select([
			"claim_dokument.id as id",
			"claim_dokument.*",
			"dokumen.name AS name",
		])
			->join('dokumen', 'dokumen.id', 'document_id')
			->where('claim_dokument.claim_id', $id)
			->get();

		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->where('claim_produk.claim_id', $id)
			->get();

		$pdf = PDF::loadView('backend.claim.cetak', compact('spr', 'app', 'appz', 'dokumen', 'produk'))->setPaper('a4', 'potrait');
		return $pdf->stream();
	}

	public function cetak_tt($id)
	{
		$spr = Claim::find($id);
		$app = ClaimApproval::where('claim_id', $id)->get();
		$appz = ClaimFlowDokumen::where('claim_id', $id)->get();
		$dokumen = ClaimDokumen::select([
			"claim_dokument.id as id",
			"claim_dokument.*",
			"dokumen.name AS name",
		])
			->join('dokumen', 'dokumen.id', 'document_id')
			->where('claim_dokument.claim_id', $id)
			->get();

		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->where('claim_produk.claim_id', $id)
			->get();

		$pdf = PDF::loadView('backend.claim.cetak_tt', compact('spr', 'app', 'appz', 'dokumen', 'produk'))->setPaper('b5', 'landscape');
		return $pdf->stream();
	}


	public function cetak_bulk(Request $request)
	{
		if (!$request->has('ids')) {
			return redirect()->back()->with('alert', [
				'type' => 'danger',
				'msg' => 'Silahkan pilih data',
			]);
		}

		$spr = Claim::whereIn('id', $request->input('ids'))->get();
		$app = ClaimApproval::whereIn('claim_id', $request->input('ids'))->get();
		$appz = ClaimFlowDokumen::whereIn('claim_id', $request->input('ids'))->get();
		$dokumen = ClaimDokumen::select([
			"claim_dokument.id as id",
			"claim_dokument.*",
			"dokumen.name AS name",
		])
			->join('dokumen', 'dokumen.id', 'document_id')
			->whereIn('claim_dokument.claim_id', $request->input('ids'))
			->get();

		$produk = ClaimProduk::select([
			"claim_produk.id as id",
			"claim_produk.*",
			"produk.nama AS nama",
		])
			->join('produk', 'produk.id', 'produk_id')
			->whereIn('claim_produk.claim_id', $request->input('ids'))
			->get();

		$pdf = PDF::loadView('backend.claim.cetak_multi', compact('spr', 'app', 'appz', 'dokumen', 'produk'))->setPaper('A4', 'potrait');
		return $pdf->stream();
	}

	public function deleted($id)
	{
		$spr = Claim::where('id', $id)->delete();
		$app = ClaimApproval::where('claim_id', $id)->delete();
		$appz = ClaimFlowDokumen::where('claim_id', $id)->delete();
		$dokumen = ClaimDokumen::where('claim_id', $id)->delete();
		$produk = ClaimProduk::where('claim_id', $id)->delete();

		return redirect('claim')->with('success', _lang('Deleted Sucessfully'));
	}
}