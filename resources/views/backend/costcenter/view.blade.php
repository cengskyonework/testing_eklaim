@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Data Cost Center') }}</h4>

			  <table class="table table-bordered">
				<tr><td style="width:200px;">{{ _lang('CostCenter') }}</td><td>{{ $costcenter->cost_number }}</td></tr>
				<tr><td>{{ _lang('Cost Name') }}</td><td>{{ $costcenter->cost_name }}</td></tr>
				<tr><td>{{ _lang('Cost Code') }}</td><td>{!! $costcenter->cost_code !!}</td></tr>
				<tr><td>{{ _lang('Approval') }}</td><td>1. {{ isset($costcenter->appv1) ? $costcenter->namaapp1->name : '' }}<br>
														2. {{ isset($costcenter->appv2) ? $costcenter->namaapp2->name : '' }}<br>
														3. {{ isset($costcenter->appv3) ? $costcenter->namaapp3->name : '' }}<br>
														4. {{ isset($costcenter->appv4) ? $costcenter->namaapp4->name : '' }}<br>
														5. {{ isset($costcenter->appv5) ? $costcenter->namaapp5->name : '' }}<br>
														6. {{ isset($costcenter->appv6) ? $costcenter->namaapp6->name : '' }}<br>
														7. {{ isset($costcenter->appv7) ? $costcenter->namaapp7->name : '' }}<br>
														8. {{ isset($costcenter->appv8) ? $costcenter->namaapp8->name : '' }}<br>
														9. {{ isset($costcenter->appv9) ? $costcenter->namaapp9->name : '' }}<br>
														10. {{ isset($costcenter->appv10) ? $costcenter->namaapp10->name : '' }}<br>
											   </td></tr>
				
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


