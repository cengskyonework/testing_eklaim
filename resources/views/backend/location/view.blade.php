@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Location') }}</h4>

			  <table class="table table-bordered">
				<tr><td>{{ _lang('Name') }}</td><td>{{ $location->name }}</td></tr>
			
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


