@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Add Departments') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('departments')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Departments Code') }}</label>						
					<input type="text" class="form-control" name="department_code" value="{{ old('department_code') }}" required>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Departments Name') }}</label>						
					<input type="text" class="form-control" name="department_name" value="{{ old('department_name') }}" required>
				  </div>
				</div>

				
				<div class="col-md-12">
				  <div class="form-group">
					<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
					<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
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


