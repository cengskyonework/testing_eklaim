@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Region') }}</h4>

			  <table class="table table-bordered">
				<tr><td>{{ _lang('Name') }}</td><td>{{ $region->region_city }}</td></tr>
				<tr><td>{{ _lang('Name') }}</td><td>{{ $region->region_address }}</td></tr>
			
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


