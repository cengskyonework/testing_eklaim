@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Approval Data Klaim') }}</span>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
				    <th>{{ _lang('ID Claim') }}</th>
					<th>{{ _lang('No Verifikasi') }}</th>
					<th>{{ _lang('Distributor') }}</th>
					<th>{{ _lang('Kategori Klaim') }}</th>
					<th>{{ _lang('Deskripsi Cost Center') }}</th>
					<th>{{ _lang('Region') }}</th>
					<Th>{{ _lang('Cost Center') }}</th>
					<th>{{ _lang('Nilai Klaim') }}</th>
					<th>{{ _lang('Status Klaim') }}</th>
					<th>{{ _lang('Tanggal Klaim') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($claim as $claim)
				  <tr id="row_{{ $claim->id }}">
				    <td class='id'>{{ $claim->id }}</td>
					<td class='name'>{{ $claim->nomor }}</td>
					<td class='distributor_id'>{{ isset($claim->distributor_id) ? $claim->distributor_name->name : '' }}</td>
					<td class='cat_id'>{{ isset($claim->category_id) ? $claim->cat_name->name : '' }}</td>
					<td class='promo_id'>{{ isset($claim->promo_id) ? $claim->promo->chanel_name : '' }}</td>
					<td class='region_id'>{{ isset($claim->region_id) ? $claim->region_name->region_city : '' }}</td>
					<td class='promo_id'>{{ isset($claim->cost_id) ? $claim->cost_name->cost_number : '' }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($claim->nominal) }}</td>	
					<td class='status'>{!! klaim_status($claim->status) !!}</td>
					<td class='price'>{{ date('d-m-Y', strtotime($claim->created_at)) }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
							{{ csrf_field() }}						  
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('ApprovalController@show', $claim['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>	
							</div>
						</div>
					</td>
				  </tr>
				  @endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection


