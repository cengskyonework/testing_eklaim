@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Data Deskripsi Cost Center') }}</h4>
			  <table class="table table-bordered">
				<tr><td style="width:200px;">{{ _lang('Channel Name') }}</td><td>{{ $channel->chanel_name }}</td></tr>
				<tr><td>{{ _lang('Status') }}</td><td>{!! $channel->status !!}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


