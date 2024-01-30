@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Data Program') }}</h4>

			  <table class="table table-bordered">
				<tr><td style="width:200px;">{{ _lang('Nama Program') }}</td><td>{{ $promo->name }}</td></tr>
				<tr><td>{{ _lang('Masa Berlaku') }}</td><td>{{ $promo->start_date .' S/D '. $promo->end_date}}</td></tr>
				<tr><td>{{ _lang('Wilayah Program') }}</td><td>{{ $promo->wilayah }}</td></tr>
				<tr><td>{{ _lang('Deskripsi') }}</td><td>{!! $promo->description !!}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


