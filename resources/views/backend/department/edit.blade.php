@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Departments') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('DepartmentsController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-6">
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Departments Code') }}</label>						
							<input type="text" class="form-control" name="department_code" value="{{ $department->department_code }}" required>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Departments Name') }}</label>						
							<input type="text" class="form-control" name="department_name" value="{{ $department->department_name }}" required>
						  </div>
						</div>
						
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
							  </div>
							</div>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>

@endsection


