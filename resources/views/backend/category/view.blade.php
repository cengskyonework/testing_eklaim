@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Data Jenis Klaim') }}</h4>
			  <table class="table table-bordered">
				<tr><td style="width:200px;">{{ _lang('Category Name') }}</td><td>{{ $category->name }}</td></tr>
				<tr><td>{{ _lang('Status') }}</td><td>{{ as_status($category->status) }}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


