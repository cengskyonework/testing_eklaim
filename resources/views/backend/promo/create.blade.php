@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Input Data Program') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('promo')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Nama Program') }}</label>						
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			  </div>
			</div>

			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Tanggal Mulai Pada Sistem') }}</label>						
				<input type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date') }}" required>
			  </div>
			</div>

			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Tanggal Akhir Pada Sistem') }}</label>						
				<input type="text" class="form-control datepicker" name="end_date" value="{{ old('end_date') }}" required>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Wilayah Program') }}</label>						
				<input type="text" class="form-control" name="wilayah" value="{{ old('wilayah') }}" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Deskripsi Program') }}</label>						
				<textarea class="form-control summernote" name="description"></textarea>
			  </div>
			</div>
	
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Foto') }} 800px X 500px</label>						
				<input type="file" class="dropify" name="image">
			  </div>
			</div>
		
			<div class="col-md-12">
			  <div class="form-group">
				<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
				<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
			  </div>
			</div>
        </div>			
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection
@section('js-script')
<script type="text/javascript">
$('.gaji').mask('000.000.000', {reverse: true});
$('.npwp').mask('00.000.000.0-000.000' , {reverse: true});
</script>
@endsection
