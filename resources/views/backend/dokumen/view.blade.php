@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Departments') }}</h4>

			  <table class="table table-bordered">
				<tr><td>{{ _lang('Departments Code') }}</td><td>{{ $department->department_code }}</td></tr>
				<tr><td>{{ _lang('Departments Name') }}</td><td>{{ $department->department_name }}</td></tr>
			
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


