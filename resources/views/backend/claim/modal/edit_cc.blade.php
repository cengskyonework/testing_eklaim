<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('claim.update_cc', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	{{ method_field('PUT')}}
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Nama Distributor') }}</label>						
		<input type="text" class="form-control" name="yyyyy" value="{{ $transaktions->distributor_name->name }}" readonly>
	 </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Jenis Klaim') }}</label>						
		<input type="text" class="form-control" name="xxxx" value="{{ $transaktions->cat_name->name }}" readonly>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Tanggal Klaim') }}</label>						
		<input type="text" class="form-control" name="xxxxx" value="{{ date('Y-m-d',strtotime($transaktions->created_at)) }}" readonly>
	 </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Deskripsi Cost Center') }}</label>						
		<select class="form-control select2" name="promo_id" required>
				    <option value="">== Pilih Chanel ==</option>
					{{ create_option('chanel','id','chanel_name', $transaktions->promo_id) }}
	    </select>
	 </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Note Perubahan') }}</label>						
		<input type="text" class="form-control" name="note_perubahan" value="" >
	 </div>
	</div>


	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Cost Center') }}</label>						
		<select class="form-control select2" name="cost_id" id="cost_id" required>
				    <option value="">== Pilih Cost Center ==</option>
					{{ create_option('costcenter','id','cost_number', $transaktions->cost_id) }}
		</select>
	 </div>
	</div>
	
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Konfirmasi') }}</button>
	  </div>
	</div>
</form>
<script type="text/javascript">
$(function(){
	$('.float-field').mask('000,000,000,000', {reverse: true});
	
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('select[name=promo_id]').change(function () {
		
        var id = $(this).val();
		
        $.ajax({
            url: '{{ route('claim.get_data_chanel') }}',
            method: 'GET',
            data: {
				'id':id,
			},
            success: function (response) {
                $('#cost_id').empty();
                $.each(response, function (id , name) {
                    $('#cost_id').append('<option value="' +id+ '">'+ name +'</option>');
                })
            }
        })
    });
});	
</script>