@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Category') }}</h4>

			  <table class="table table-bordered">
				<tr><td>{{ _lang('Name') }}</td><td>{{ $blogcategory->name }}</td></tr>
			<tr><td>{{ _lang('Description') }}</td><td>{{ $blogcategory->description }}</td></tr>
			
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


