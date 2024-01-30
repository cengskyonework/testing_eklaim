@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View FAQ') }}</h4>

			  <h4>{{ $faq->question }}</h4>
			  <p style="line-height:26px">{{ $faq->answer }}</p>	
			</div>
	    </div>
	</div>
</div>
@endsection


