@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Data CostCenter') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('CostCenterController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-9">
						  <div class="form-group">
							<label class="control-label">{{ _lang('CostCenter') }}</label>						
							<input type="text" class="form-control" name="cost_number" value="{{ $costcenter->cost_number }}" required>
						  </div>
						</div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Cost Code') }}</label>						
							<input type="text" class="form-control" name="cost_code" value="{{ $costcenter->cost_code }}" required>
						  </div>
						</div>

						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Cost Name') }}</label>						
							<input type="text" class="form-control" name="cost_name" value="{{ $costcenter->cost_name }}" required>
						  </div>
						</div>
						
					    <div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Deskripsi Cost Center') }}</label>						
							<select class="form-control select2" name="chanel_id" required>
								<option value="">== Pilih Channel ==</option>
								{{ create_option('chanel','id','chanel_name', $costcenter->chanel_id) }}
							</select>
						  </div>
						</div>
						
						<h4 class="card-title panel-title">{{ _lang('Data Approval') }}</h4>
			
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 1') }}</label>						
							<select class="form-control select2" name="appv1" required>
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv1) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 2') }}</label>						
							<select class="form-control select2" name="appv2">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv2) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 3') }}</label>						
							<select class="form-control select2" name="appv3">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv3) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 4') }}</label>						
							<select class="form-control select2" name="appv4">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv4) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 5') }}</label>						
							<select class="form-control select2" name="appv5">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv5) }}
							</select>
						  </div>
						</div>
						
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 6') }}</label>						
							<select class="form-control select2" name="appv6">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv6) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 7') }}</label>						
							<select class="form-control select2" name="appv7">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv7) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 8') }}</label>						
							<select class="form-control select2" name="appv8">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv8) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 9') }}</label>						
							<select class="form-control select2" name="appv9">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv9) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Approval 10') }}</label>						
							<select class="form-control select2" name="appv10">
								<option value="">== Pilih ==</option>
								{{ create_option('users','id','name', $costcenter->appv10) }}
							</select>
						  </div>
						</div>

						<div class="col-md-12">
						  <div class="form-group">
							<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
						  </div>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>

@endsection



