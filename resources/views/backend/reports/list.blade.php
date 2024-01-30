@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Reports Data Klaim') }}</span>
				<a class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#exportModal" >{{ _lang('Export Data') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('No Verifikasi') }}</th>
					<th>{{ _lang('Tanggal Klaim') }}</th>
					<th>{{ _lang('Distributor') }}</th>
					<th>{{ _lang('Kategori Klaim') }}</th>
					<th>{{ _lang('Distributor Channel') }}</th>
					<th>{{ _lang('Region') }}</th>
					<Th>{{ _lang('Cost Center') }}</th>
					<th>{{ _lang('Nilai Klaim') }}</th>
					<th>{{ _lang('Status Klaim') }}</th>

				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($claim as $claim)
				  <tr id="row_{{ $claim->id }}">
					<td class='name'>{{ $claim->nomor }}</td>
					<td class='user_id'>{{ tgl_indo($claim->created_at) }}</td>
					<td class='distributor_id'>{{ isset($claim->distributor_id) ? $claim->distributor_name->name : '' }}</td>
					<td class='cat_id'>{{ isset($claim->category_id) ? $claim->cat_name->name : '' }}</td>
					<td class='promo_id'>{{ isset($claim->promo_id) ? $claim->promo->chanel_name : '' }}</td>
					<td class='region_id'>{{ isset($claim->region_id) ? $claim->region_name->region_city : '' }}</td>
					<td class='promo_id'>{{ isset($claim->cost_id) ? $claim->cost_name->cost_number : '' }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($claim->nominal) }}</td>
					@if(empty($claim->admin_date))
						<td class='status'><span class="badge badge-primary">Claim Baru</span></td>
					@else
						<td class='status'>{!! klaim_status($claim->status) !!}</td>
					@endif
				  </tr>
				  @endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modal">Export Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="export" method="post" id="exportFormModal">
                        @csrf
                        <div class="form-group">
                            <label class="control-label">Tanggal Awal</label>
                            <input type="text" class="form-control datepicker" name="start_date" required placeholder="Pilih Tanggal">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tanggal Akhir</label>
                            <input type="text" class="form-control datepicker" name="end_date" required placeholder="Pilih Tanggal">
                        </div>
						<div class="form-group">
                            <label class="control-label">Cost Center</label>
                             <select class="form-control select2" name="cost_id" required>
								<option value="all">== All ==</option>
								{{ create_option('costcenter','id','cost_number',['status' => 'A']) }}
							</select>
                        </div>
						<div class="form-group">
                            <label class="control-label">Distributor</label>
                             <select class="form-control select2" name="distributor_id" required>
								<option value="all">== All ==</option>
								{{ create_option('distributor','id','name',['status' => 1]) }}
							</select>
                        </div>
						<div class="form-group">
                            <label class="control-label">Jenis Reports</label>
                             <select class="form-control select2" name="laporan" required>
								<option value="1">== Admin ==</option>
								<option value="2">== Accounting ==</option>
							</select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary"><i class="fa fa-save"></i> Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


