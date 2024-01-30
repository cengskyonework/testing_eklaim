<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('approval.simpan_konfirm_fat', $id) }}" enctype="multipart/form-data">
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
			<input type="text" class="form-control" name="tanggal_kirim_fat" value="{{ $app->tanggal_kirim_fat }}" readonly>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Tanggal Penerimaan Dokumen') }}</label>						
			<input type="text" class="form-control datepicker" name="tanggal_terima_fat" value="" required>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Status Penerimaan Dokumen') }}</label>						
			<select name="status_terima_fat" class="form-control select2" required>
				<option></option>
				<option value="1" {{ $app->status_terima_fat == 1 ? 'selected' : '' }}>{{ _lang('Di Terima') }}</option>
				<option value="2" {{ $app->status_terima_fat == 2 ? 'selected' : '' }}>{{ _lang('Di Pending') }}</option>
			</select>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Catatan') }}</label>						
			<textarea class="form-control" name="note_balik_fat" value="">{{ $app->note_balik_fat }}</textarea>
		 </div>
		</div>
	@endforeach		
			
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Konfirmasi') }}</button>
	  </div>
	</div>
</form>

<script type="text/javascript">
$(function(){
	$('.float-field').mask('000,000,000,000', {reverse: true});
});	
</script>
