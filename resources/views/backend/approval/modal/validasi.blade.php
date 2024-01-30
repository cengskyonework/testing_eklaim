<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('approval.simpan_validasi_acc', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}

	@php $currency = currency() @endphp
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('No Verifikasi') }}</label>						
		<input type="text" class="form-control" value="{{ $spr->nomor }}" readonly>
	 </div>
	</div>

	<input type="hidden" name="claim_id" value="{{ $spr->id }}" >
								<h5>Data Nilai Klaim Produk</h5>
								  <table width="100%" class="table table-bordered">			  
													<tr><td align="center">Nama Produk</td><td align="center">Qty</td><td align="center">Satuan</td><td align="center">Jumlah</td><td align="center">DPP</td></tr>		
									@foreach($produk as $item)
									<tr>
										<td align="center" ><input type="hidden" name="produk_id[]" value="{{ $item->produk_id }}" >
										<input type="hidden" name="idx[]" value="{{ $item->produk_id }}" >{{ $item->nama }}</td>
										<td width="15%" ><input type="text" class="form-control qty" name="qty[]" value="{{ $item->qty }}"></td>
										<td width="10%"><input type="text" class="form-control" name="satuan[]" value="{{ $item->satuan }}" readonly></td>
										<td width="20%"><input type="text" class="form-control float-nominalx" name="nilai[]" value="{{ number_format($item->nilai,2) }}"></td>
										<td width="20%"><input type="text" class="form-control float-dppx" name="dpp[]" value="{{ number_format($item->dpp,2) }}" ></td>
									</tr>
									@endforeach
								  </table>
								<table width="100%" class="table-bordered">
									<tr>
										<td>Nilai Klaim User</td>
										<td><input type="text" name="nominal" class="form-control totalx" value="{{ number_format($spr->nominal,2) }}" ></td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (DPP)</td>
										<td><input type="text" class="form-control total-dppx" onblur="hitung();" name="tot_dpp" value="{{ number_format($spr->dpp,2) }}" ></td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (PPN 11%)</td>
										<td><input type="text" class="form-control total-ppnx" onblur="hitung();" name="tot_ppn" value="{{ number_format($spr->ppn,2)}}"><td>
									</tr>
									<tr>
										<td>Nilai Realisasi Accounting (PPH)</td>
										<td><input type="text" class="form-control total-pphx" onblur="hitung();" name="tot_pph" value="{{ number_format($spr->pph,2) }}" ></td>
									</tr>
									<tr>
										<td>Total Realisasi</td>
										<td><input type="text" class="form-control totalan" name="xswax" value="{{ number_format(($spr->dpp + $spr->ppn - $spr->pph),2) }}" readonly></td>
									</tr>
									
								</table><br>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">{{ _lang('Validasi') }}</button>
								</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('.qty').mask('000,000', {reverse: true});
	$('.float-field').mask('000,000,000.00', {reverse: true});
	$('.totalx').mask('000,000,000.00', {reverse: true});
	$('.totalan').mask('000,000,000.00', {reverse: true});
	$('.total-dppx').mask('000,000,000.00', {reverse: true});
	$('.total-ppnx').mask('000,000,000.00', {reverse: true});
	$('.total-pphx').mask('000,000,000.00', {reverse: true});
	$('.float-nominalx').mask('000,000,000.00', {reverse: true});
	$('.float-dppx').mask('000,000,000.00', {reverse: true});
	$('.float-ppn').mask('000,000,000.00', {reverse: true});
	$('.float-pph').mask('000,000,000.00', {reverse: true});
});
	
$(document).on("blur", ".float-nominalx", function() {
    var sum = 0;
    $(".float-nominalx").each(function(){	
		var num = $(this).val();	
        sum += +num.replace(/,/g,'');
    });
    $(".totalx").val(sum);
});

$(document).on("blur", ".float-dppx", function() {
    var sumx = 0;
    $(".float-dppx").each(function(){	
		var numx = $(this).val();	
        sumx += +numx.replace(/,/g,'');
    });
    $(".total-dppx").val(sumx);
});

$(document).on("blur", ".float-ppnx", function() {
    var sumy = 0;
    $(".float-ppnx").each(function(){	
		var numy = $(this).val();	
        sumy += +numy.replace(/,/g,'');
    });
    $(".total-ppnx").val(sumy);
});

$(document).on("blur", ".float-pphx", function() {
    var sumz = 0;
    $(".float-pphx").each(function(){	
		var numz = $(this).val();	
        sumz += +numz.replace(/,/g,'');
    });
    $(".total-pphx").val(sumz);
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
    $("input[name=xswax]").val(f);
}
</script>
