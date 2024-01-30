<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('claim.simpan_ap', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	@php $currency = currency() @endphp
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('No Verifikasi') }}</label>						
		<input type="text" class="form-control" value="{{ $transaktions->nomor }}" readonly>
	 </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Nomor AP') }}</label>						
		<input type="text" class="form-control" name="no_ap" value="{{ $transaktions->no_ap }}" required>
	 </div>
	</div>
			
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Submit') }}</button>
	  </div>
	</div>
</form>

<script type="text/javascript">
$(function(){
	$('.float-field').mask('000,000,000,000', {reverse: true});
});	
</script>
