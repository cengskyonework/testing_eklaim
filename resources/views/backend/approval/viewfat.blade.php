@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Accounting Approval Data Klaim') }}   			  
			  @if ($spr->status == 'A') <span class="badge badge-primary">Menunggu Konfirmasi / Approval</span> 
			  @elseif($spr->status == 'B') 
				@if($spr->flag_acc == 2)
					<span class="badge badge-success">Pengiriman Data Ke Accounting</span> 
				@elseif($spr->flag_acc == 3)
					<span class="badge badge-success">Konfirmasi Accounting</span>
				@elseif($spr->flag_acc == 4) 
					<span class="badge badge-success">Pengiriman Data Ke Finance</span>
				@elseif($spr->flag_acc == 5)
					<span class="badge badge-success">Konfirmasi Finance</span>
				@endif
			  @elseif($spr->status == 'C') <span class="badge badge-success">Klaim Dibayarkan</span>
			  @elseif($spr->status == 'F') <span class="badge badge-success">Klaim Dipotong dana pembentukan HCO</span>					  
			  @elseif($spr->status == 'P') 
				@if($spr->internal_pend == 1)
					@if(Auth::user()->user_type != 'user')
						<span class="badge badge-dark">Klaim DiPending Internal</span>
					@else
						<span class="badge badge-primary">Menunggu Konfirmasi / Approval</span>
					@endif
				@else
					<span class="badge badge-dark">Klaim DiPending</span> 
				@endif
			  @elseif($spr->status == 'T') <span class="badge badge-danger">Klaim Tidak Dibayarkan</span>
			  @elseif($spr->status == 'N') <span class="badge badge-primary">Klaim Baru</span>			  
			  @else <span class="badge badge-danger">Ditolak</span> @endif</h4>
			  @if(Auth::user()->user_type == 'accounting' || Auth::user()->user_type == 'admin' )
					@if (($spr->flag_acc == 2 && $spr->status == 'B') || ($spr->flag_acc == 2 && $spr->status == 'P'))
						<button class="btn btn-warning btn-sm float-right ajax-modal" data-title="{{ _lang('Konfirmasi Data') }}" data-href="{{ action('ApprovalController@konfirm_acc' , $id) }}">{{ _lang('Konfirmasi Data') }}</button>
					@endif
			  @endif
			  <br>
			  <h5>Data Distributor Klaim</h5>
			  <table class="table table-bordered">
				<tr><td style="width:250px;">{{ _lang('Nomor Verifikasi') }}</td><td>{{ $spr->nomor }} </td></tr>
				<tr><td>{{ _lang('Nama Konsumen') }}</td><td>{{ isset($spr->distributor_id) ? $spr->distributor_name->name : '' }}</td></tr>
				<tr><td>{{ _lang('No Identitas') }}</td><td>{{ $spr->distributor_name->id_no }}</td></tr>
				<tr><td>{{ _lang('No Telepon / HP') }}</td><td>{{ $spr->distributor_name->hp }}</td></tr>
				<tr><td>{{ _lang('Email') }}</td><td>{{ $spr->distributor_name->email }}</td></tr>
				<tr><td>{{ _lang('NPWP') }}</td><td>{{ $spr->distributor_name->npwp }}</td></tr>
				<tr><td>{{ _lang('Alamat') }}</td><td>{{ $spr->distributor_name->address }}</td></tr>
				<tr><td>{{ _lang('Nama Bank Distributor') }}</td><td>{{ $spr->bank_name->nama_bank }}</td></tr>
				<tr><td>{{ _lang('No Rekening / Nama Rekening') }}</td><td>{{ $spr->no_rek .' / '. $spr->nama_rek }}</td></tr>
			  </table>
			  <br>
			  <h5>Data Klaim</h5>
			  <table class="table table-bordered">
				<tr><td style="width:250px;">{{ _lang('Deskripsi Cost Center / Cost Center') }}</td><td>{{ $spr->promo->chanel_name .' / '. $spr->cost_name->cost_number  }} </td></tr>
				<tr><td>{{ _lang('Periode Klaim') }}</td><td>{{ $spr->periode_start .' s/d '. $spr->periode_end  }}</td></tr>
				<tr><td>{{ _lang('Region / Area') }}</td><td>{{ $spr->region_name->region_city }}</td></tr>
				<tr><td>{{ _lang('No Surat Claim Distributor') }}</td><td>{{ $spr->surat_jalan }}</td></tr>
				<tr><td>{{ _lang('No Surat Program') }}</td><td>{{ $spr->no_surat }}</td></tr>
				<tr><td>{{ _lang('Nama Program') }}</td><td>{{ $spr->promox->name }}</td></tr>
				<tr><td>{{ _lang('Wilayah Program') }}</td><td>{{ $spr->promox->wilayah }}</td></tr>
				<tr><td>{{ _lang('Jenis Claim') }}</td><td>{{ $spr->cat_name->name }}</td></tr>
				<tr><td>{{ _lang('Subject / Judul Email') }}</td><td>{{ $spr->judul_email }}</td></tr>
			  </table>
			  <br>
			  <h5>Data Produk</h5>
			  <table class="table table-bordered">			  
				<tr><td align="center">Nama Produk</td><td align="center">Qty</td><td align="center">Satuan</td><td align="center">Jumlah</td><td align="center">DPP</td><td align="center">PPN</td><td align="center">PPH</td></tr>		
				@foreach($produk as $item)
				<tr>
				<td align="center" >{{ $item->nama }}</td>
				<td align="center" >{{ $item->qty }}</td>
				<td align="center" >{{ $item->satuan }}</td>
				<td align="center" class="isi">{{ 'Rp.'.number_format($item->nilai,2) }}</td>
				<td align="center" class="isi">{{ 'Rp.'.number_format($item->dpp,2) }}</td>
				<td align="center" class="isi">{{ 'Rp.'.number_format($item->ppn,2) }}</td>
				<td align="center" class="isi">{{ 'Rp.'.number_format($item->pph,2) }}</td>
				</tr>
				@endforeach
				<tr>
				<td align="right" colspan="3"><b>Total Klaim (Rp)</b></td>
				<td align="center" class="isi"><b>{{ 'Rp.'.number_format($spr->nominal,2) }}</b></td>
				<td align="center" class="isi"><b>{{ 'Rp.'.number_format($spr->dpp,2) }}</b></td>
				<td align="center" class="isi"><b>{{ 'Rp.'.number_format($spr->ppn,2) }}</b></td>
				<td align="center" class="isi"><b>{{ 'Rp.'.number_format($spr->pph,2) }}</b></td>
				</tr>
			  </table>
			  <br>
			  <h5>Data Dokumen</h5>
			  <table class="table table-bordered">
				<table class="table table-bordered">			  
				<tr><td colspan="2" align="left"><b>Nama Dokumen</b></td></tr>		
				@foreach($dokumen as $itemy)
					@if($itemy->count() > 0)
						<tr><td colspan="2" align="left" >&#x2705;{{ $itemy->name }}</td></tr>
					@endif
				@endforeach
				<tr><td align="left"><b>Nama File Yang Dikirim</b></td><td width="70%" align="left">{{ $spr->nama_document }}</td></tr>	
			  </table>
			  </table>
			  <br>
			  <div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">History Note Perubahan Admin</h4>
					</div>
					<div class="card-body">
					   <ol class="activity-feed">
							@foreach ($notes as $note)
							   <li class="feed-item feed-item-success">
								  <table><tr><td width="5%">
								   @if(!empty($note->admin->profile_picture))
										<span>
											<img class="rounded-circle" src="{{asset('public/uploads/profile/'.$note->admin->profile_picture)}}" width="40" height="40">
										</span>
								   @else
									   <span>
											<img class="rounded-circle" src="{{asset('public/images/avatar.png')}}" width="40" height="40">
									   </span>
								   @endif</td><td>
								   <span class="text"><b style="color:blue">{{ $note->admin->name }}</b>&nbsp;<i>{{ date("d-m-Y H:i:s",strtotime($note->created_at)) }}</i></span><br>
								   <span class="text">{{ $note->claim_admin_note }}</span></td></tr></table>
							   </li>
							@endforeach
					   </ol>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>	
			
	<div class="col-6">
			<div class="card">
				<div class="card-header">
							<h4 class="card-title">History Approval</h4>
				</div>
				<div class="card-body">
				@if(Auth::user()->user_type != 'user')
				   <ol class="activity-feed">
								 @if(!empty($spr->admin_date))
                                <li class="feed-item feed-item-success">
									<span class="text">{{ $spr->admin_date }}</span>
									<br>
									<span class="text"><b>{{ $spr->upd_name->name }}</b> sudah melakukan konfirmasi cost center atas klaim</span>
							    </li>
                                @endif
						@foreach ($app as $item)
							@if($item->count() > 0)
                                @if(!empty($item->approved_1))
                                <li class="feed-item feed-item-{{ log_status($item->status) }}">
									<span class="text">{{ $item->approved_1_date }}</span>
									<br>
									<span class="text">{!! ptk_status($item->status) !!} oleh <b>{{ $item->nama1->name }}</b> "{{ $item->note_appv1 }}"</span>
							    </li>
                                @endif
								@if(!empty($item->approved_2))
                                <li class="feed-item feed-item-{{ log_status($item->status2) }}">
									<span class="text">{{ $item->approved_2_date }}</span>
									<br>
									<span class="text">{!! ptk_status($item->status2) !!} oleh <b>{{ $item->nama2->name }}</b> "{{ $item->note_appv2 }}"</span>
								</li>
                                @endif
								@if(!empty($item->approved_3))
                                    <li class="feed-item feed-item-{{ log_status($item->status3) }}">
										<span class="text">{{ $item->approved_3_date }}</span>
										<br>
										<span class="text">{!! ptk_status($item->status3) !!} oleh <b>{{ $item->nama3->name }}</b> "{{ $item->note_appv3 }}"</span>
								    </li>
                                @endif
								@if(!empty($item->finance_appv))
                                    <li class="feed-item feed-item-{{ log_status($item->status_finance) }}">
										<span class="text">{{ $item->finance_appv_date }}</span>
										<br>
										<span class="text">{!! fat_status($item->status_finance) !!} oleh <b>{{ $item->nama_fat->name }}</b> "{{ $item->note_finance }}"</span>
								    </li>
                                @endif
								@if(!empty($item->acc_appv))
                                    <li class="feed-item feed-item-{{ log_status($item->status_acc) }}">
										<span class="text">{{ $item->acc_appv_date }}</span>
										<br>
										<span class="text">{{ $item->status_acc == 1 ? 'Disetujui finance sudah dibayarkan':'Ditolak' }} Finance oleh <b>{{ $item->nama_acc->name }}</b> "{{ $item->note_acc }}"</span>
								    </li>
                                @endif
							@endif
						@endforeach
						</ol>
				@endif
				</div>
			  </div>
			</div>
			
			<div class="col-6">
			<div class="card">
				<div class="card-header">
							<h4 class="card-title">History Flow Dokumen</h4>
				</div>
				<div class="card-body">
				@if(Auth::user()->user_type != 'user')
				   <ol class="activity-feed">
						@foreach ($appz as $itemx)
						    @if($itemx->count() > 0)
                                @if(!empty($itemx->admin_kirim))
									<li class="feed-item feed-item-success">
										<span class="text">{{ date('d-m-Y', strtotime($itemx->tanggal_kirim_acc)) }}</span>
										<br>
										<span class="text">Admin Kirim data ke accounting Oleh <b>{{ $itemx->nama_admin->name }}</b> "{{ $itemx->note_kirim_acc }}"</span>
									</li>
                                @endif
								@if(!empty($itemx->acc_terima))
									<li class="feed-item feed-item-{{ log_status($itemx->status_terima_acc) }}">
										<span class="text">{{ date('d-m-Y', strtotime($itemx->tanggal_terima_acc)) }}</span>
										<br>
										<span class="text">{{ $itemx->status_terima_acc == 1 ? 'Data dari admin diterima':'Data dari admin di pending' }} oleh Accounting <b>{{ $itemx->nama_admin_acc->name }}</b> "{{ $itemx->note_balik_acc }}"</span>
									</li>
                                @endif
								@if(!empty($itemx->acc_kirim))
                                   <li class="feed-item feed-item-success">
										<span class="text">{{ date('d-m-Y', strtotime($itemx->tanggal_kirim_fat)) }}</span>
										<br>
										<span class="text">Accounting kirim data ke finance, <b>{{ $itemx->nama_admin2_acc->name }}</b> "{{ $itemx->note_kirim_fat }}"</span>
								    </li>
                                @endif
								@if(!empty($itemx->fat_terima))
                                    <li class="feed-item feed-item-{{ log_status($itemx->status_terima_fat) }}">
										<span class="text">{{ date('d-m-Y', strtotime($itemx->tanggal_terima_fat)) }}</span>
										<br>
										<span class="text">{{ $itemx->status_terima_fat == 1 ? 'Data dari accounting diterima':'Data dari accounting Di Pending' }} oleh Finance <b>{{ $itemx->nama_admin_fat->name }}</b> "{{ $itemx->note_balik_fat }}"</span>
								    </li>
                                @endif
							@endif
						@endforeach
						</ol>
				@endif
				</div>
			  </div>
			</div>
			
			
			
			<!-- MULAI APPROVAL -->
			@if (($spr->flag_acc == 3 && $spr->status == 'B') || ($spr->flag_acc == 3 && $spr->status == 'P'))
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Form Accounting</h4>
							<button class="btn btn-dark btn-sm float-right ajax-modal" data-title="{{ _lang('Validasi Nilai') }}" data-href="{{ action('ApprovalController@validasi_acc' , $id) }}">{{ _lang('Validasi Nilai') }}</button>
						</div>
						
						<div class="card-body">
							<form action="{{ route('approval.fa_approve') }}" method="post" onsubmit="return confirm('Anda Yakin ?')">
								@csrf
								<input type="hidden" name="claim_id" value="{{ $spr->id }}" >
								<h5>Data Nilai Klaim Produk</h5>
								  <table class="table table-bordered">			  
													<tr><td align="center">Nama Produk</td><td align="center">Qty</td><td align="center">Satuan</td><td align="center">Jumlah</td><td align="center">DPP</td></tr>		
									@foreach($produk as $item)
									<tr>
										<td align="center" ><input type="hidden" name="produk_id[]" value="{{ $item->produk_id }}" >{{ $item->nama }}</td>
										<td width="10%" ><input type="text" class="form-control qty" name="qty[]" value="{{ $item->qty }}"></td>
										<td width="10%"><input type="text" class="form-control" name="satuan[]" value="{{ $item->satuan }}" readonly></td>
										<td width="10%"><input type="text" class="form-control float-nominal" name="nilai[]" value="{{ $item->nilai }}"></td>
										<td width="10%"><input type="text" class="form-control float-dpp" name="dpp[]" value="{{ $item->dpp }}" ></td>
									</tr>
									@endforeach
								  </table>
								<table width="100%" class="table-bordered">
									<tr>
										<td>Nilai Klaim User</td>
										<td><input type="text" name="nominal" class="form-control total" value="{{ number_format($spr->nominal,2) }}" ></td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (DPP)</td>
										<td><input type="text" class="form-control total-dpp" onblur="hitung();" name="tot_dpp" value="{{ number_format($spr->dpp,2) }}" ></td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (PPN 11%)</td>
										<td><input type="text" class="form-control total-ppn" onblur="hitung();" name="tot_ppn" value="{{ number_format($spr->ppn,2) }}"><td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (PPH)</td>
										<td><input type="text" class="form-control total-pph" onblur="hitung();" name="tot_pph" value="{{ number_format($spr->pph,2) }}" ></td>
									</tr>
									<tr>
										<td>Total Realisasi</td>
										<td><input type="text" class="form-control totalan" name="xswa" value="{{ number_format(($spr->dpp + $spr->ppn - $spr->pph),2) }}" readonly></td>
									</tr>
									
								</table><br>
								<div class="form-group">
										<label for=""> Note Approval</label>
										<textarea name="ApprovalNote" rows="3" class="form-control"></textarea>
								</div>
								<div class="form-group">
								<label class="control-label">Status </label>
									<select name="ApprovalSts" class="form-control select2" required>
										<option></option>
										<option value="1">Setujui</option>
										<option value="3">Dipotong dana pembentukan HCO</option>
										<option value="2">Tolak</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<!-- END FORM -->
		@endif
</div>
@endsection
@section('js-script')
<script type="text/javascript">
$(document).ready(function(){
	$('.qty').mask('000,000', {reverse: true});
	$('.float-field').mask('000,000,000.00', {reverse: true});
	$('.total').mask('000,000,000.00', {reverse: true});
	$('.totalan').mask('000,000,000.00', {reverse: true});
	$('.total-dpp').mask('000,000,000.00', {reverse: true});
	$('.total-ppn').mask('000,000,000.00', {reverse: true});
	$('.total-pph').mask('000,000,000.00', {reverse: true});
	$('.float-nominal').mask('000,000,000.00', {reverse: true});
	$('.float-dpp').mask('000,000,000.00', {reverse: true});
	$('.float-ppn').mask('000,000,000.00', {reverse: true});
	$('.float-pph').mask('000,000,000.00', {reverse: true});
});
	
$(document).on("blur", ".float-nominal", function() {
    var sum = 0;
    $(".float-nominal").each(function(){	
		var num = $(this).val();	
        sum += +num.replace(/,/g,'');
    });
    $(".total").val(sum);
});

$(document).on("blur", ".float-dpp", function() {
    var sumx = 0;
    $(".float-dpp").each(function(){	
		var numx = $(this).val();	
        sumx += +numx.replace(/,/g,'');
    });
    $(".total-dpp").val(sumx);
});

$(document).on("blur", ".float-ppn", function() {
    var sumy = 0;
    $(".float-ppn").each(function(){	
		var numy = $(this).val();	
        sumy += +numy.replace(/,/g,'');
    });
    $(".total-ppn").val(sumy);
});

$(document).on("blur", ".float-pph", function() {
    var sumz = 0;
    $(".float-pph").each(function(){	
		var numz = $(this).val();	
        sumz += +numz.replace(/,/g,'');
    });
    $(".total-pph").val(sumz);
});

function hitung() {
    var a = $('input[name=tot_dpp]').val();
    var b = $('input[name=tot_ppn]').val();
	var c = $('input[name=tot_pph]').val();
	
	var aa = a.replace(/,/g,'') * 1;
	var ab = b.replace(/,/g,'') * 1;
	var ac = c.replace(/,/g,'') * 1;
	
	//pp = aa * 0.11;

    f = (aa+ab)-ac;
	
	
	//$('input[name=tot_ppn]').val(pp);
    $("input[name=xswa]").val(f);
}
</script>
@endsection
