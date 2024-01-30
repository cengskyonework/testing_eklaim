<form method="post" class="ajax-submit" autocomplete="off" action="{{route('customers.simpanan', $id)}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Nama Konsumen') }}</label>						
			<input type="text" class="form-control" value="{{ strtoupper($customers->name) }}" readonly>
		</div>
	</div>
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Jumlah Pembayaran') }}</label>						
		<input type="text" class="form-control float-field" name="nominal" value="{{ $customers->nominal }}" required>
	 </div>
	</div>	
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Tanggal Pembayaran') }}</label>						
			<input type="text" class="form-control datepicker" name="paid_date" value="{{ $customers->paid_date }}" required>
		</div>
	</div>
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Metode Pembayaran') }}</label>						
		<select class="form-control select2" name="payment_method" required>
			<option value="Cash" {{ $customers->payment_method =='Cash' ? 'selected' : '' }}>{{ _lang('Cash') }}</option>
			<option value="BCA" {{ $customers->payment_method =='BCA' ? 'selected' : '' }}>{{ _lang('Transfer BCA') }}</option>
			<option value="Mandiri"{{ $customers->payment_method =='Mandiri' ? 'selected' : '' }}>{{ _lang('Transfer Mandiri') }}</option>
		</select>
	 </div>
	</div>	
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Unggah Bukti Pembayaran') }} 800px X 500px</label>						
			<input type="file" class="dropify" name="bukti" data-default-file="{{ asset('public/uploads/buktitf/'.$customers->bukti) }}">
		</div>
	</div>							
	<div class="col-md-12">
	  <div class="form-group">
	    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
		<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
	  </div>
	</div>
</form>
<script type="text/javascript">
$(function(){
	$('.float-field').mask('000,000,000,000', {reverse: true});
});	
</script>