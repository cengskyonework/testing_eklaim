@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Input Data Deskripsi Cost Center') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('channel')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Channel Name') }}</label>						
				<input type="text" class="form-control" name="chanel_name" value="{{ old('chanel_name') }}" required>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Status Channel') }}</label>						
				<select class="form-control select2" name="status" required>
				    <option value="">== Pilih Status ==</option>
					<option value="A">Aktif</option>
					<option value="C">Non Aktif</option>
				</select>
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
