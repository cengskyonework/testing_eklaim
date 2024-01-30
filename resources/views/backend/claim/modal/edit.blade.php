<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('claim.simpan_acc', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}

	@php $currency = currency() @endphp
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('No Verifikasi') }}</label>						
		<input type="text" class="form-control" value="{{ $transaktions->nomor }}" readonly>
	 </div>
	</div>
	
	@foreach($appx as $app)
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Tanggal Pengiriman Dokumen') }}</label>						
			<input type="text" class="form-control datepicker" name="tanggal_kirim_acc" value="{{ $app->tanggal_kirim_acc }}" readonly>
		 </div>
		</div>
	@endforeach		
			
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Kirim Data') }}</button>
	  </div>
	</div>
</form>

<script type="text/javascript">
$(function(){
	$('.float-field').mask('000,000,000,000', {reverse: true});
});	
</script>
