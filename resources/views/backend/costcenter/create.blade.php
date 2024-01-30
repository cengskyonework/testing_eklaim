@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Input Data CostCenter') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('costcenter')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-9">
			  <div class="form-group">
				<label class="control-label">{{ _lang('CostCenter') }}</label>						
				<input type="text" class="form-control" name="cost_number" value="{{ old('cost_number') }}" required>
			  </div>
			</div>
			
			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Cost Code') }}</label>						
				<input type="text" class="form-control" name="cost_code" value="{{ old('cost_code') }}" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Cost Name') }}</label>						
				<input type="text" class="form-control" name="cost_name" value="{{ old('cost_name') }}" required>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Deskripsi Cost Center') }}</label>						
				<select class="form-control select2" name="chanel_id" required>
				    <option value="">== Pilih Channel ==</option>
					{{ create_option('chanel','id','chanel_name',old('chanel_id')) }}
				</select>
			  </div>
			</div>
			
			<h4 class="card-title panel-title">{{ _lang('Data Approval') }}</h4>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 1') }}</label>						
				<select class="form-control select2" name="appv1" required>
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv1')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 2') }}</label>						
				<select class="form-control select2" name="appv2">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv2')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 3') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv3')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 4') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv4')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 5') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv5')) }}
				</select>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 6') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv6')) }}
				</select>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 7') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv7')) }}
				</select>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 8') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv8')) }}
				</select>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 9') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv9')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Approval 10') }}</label>						
				<select class="form-control select2" name="appv3">
				    <option value="">== Pilih ==</option>
					{{ create_option('users','id','name',old('appv10')) }}
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
