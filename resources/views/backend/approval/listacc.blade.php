@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Finance Approval Data Klaim') }}</span>
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
					<th>{{ _lang('Cost Center') }}</th>
					<th>{{ _lang('No AP') }}</th>
					<th>{{ _lang('Nilai Klaim') }}</th>
					<th>{{ _lang('Total Realisasi') }}</th>
					<th>{{ _lang('Status Klaim') }}</th>
					<th>{{ _lang('Tanggal Klaim') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($claim as $claim)
				  @if(!empty($claim->approval->tanggal_kirim_fat))
				  <tr id="row_{{ $claim->id }}">
				    <td class='id'>{{ $claim->id }}</td>
					<td class='name'>{{ $claim->nomor }}</td>
					<td class='distributor_id'>{{ isset($claim->distributor_id) ? $claim->distributor_name->name : '' }}</td>
					<td class='cat_id'>{{ isset($claim->category_id) ? $claim->cat_name->name : '' }}</td>
					<td class='promo_id'>{{ isset($claim->promo_id) ? $claim->promo->chanel_name : '' }}</td>
					<td class='region_id'>{{ isset($claim->region_id) ? $claim->region_name->region_city : '' }}</td>
					<td class='promo_id'>{{ isset($claim->cost_id) ? $claim->cost_name->cost_number : '' }}</td>
					<td class='no_ap'>{{ isset($claim->no_ap) ? $claim->no_ap : '' }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($claim->nominal) }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($claim->dpp + $claim->ppn - $claim->pph) }}</td>
					@if(empty($claim->appz->status_acc))
						@if(empty($claim->approval->status_terima_fat))
							<td class='status'><span class="badge badge-primary">Menunggu Konfirmasi / Approval</span></td>
						@else
							<td class='status'>{!! klaim_status($claim->status) !!}</td>
						@endif
					@else
						<td class='status'>{!! klaim_status($claim->status) !!}</td>
					@endif
					<td class='price'>{{ date('d-m-Y', strtotime($claim->created_at)) }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
							{{ csrf_field() }}						  
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('ApprovalController@apvacc', $claim['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>	
							</div>
						</div>
					</td>
				  </tr>
				  @endif
				  @endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection


