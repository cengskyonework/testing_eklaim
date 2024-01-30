<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('approval.simpan_konfirm_acc', $id) }}" enctype="multipart/form-data">
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
			<input type="text" class="form-control" name="tanggal_kirim_acc" value="{{ $app->tanggal_kirim_acc }}" readonly>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Tanggal Penerimaan Dokumen') }}</label>						
			<input type="text" class="form-control datepicker" name="tanggal_terima_acc" value="" required>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Status Penerimaan Dokumen') }}</label>						
			<select name="status_terima_acc" class="form-control select2" required>
				<option></option>
				<option value="1" {{ $app->status_terima_acc == 1 ? 'selected' : '' }}>{{ _lang('Di Terima') }}</option>
				<option value="2" {{ $app->status_terima_acc == 2 ? 'selected' : '' }}>{{ _lang('Di Pending') }}</option>
			</select>
		 </div>
		</div>
		
		<div class="col-md-12">
		 <div class="form-group">
			<label class="control-label">{{ _lang('Catatan') }}</label>						
			<textarea class="form-control" name="note_balik_acc" value="">{{ $app->note_balik_acc }}</textarea>
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
