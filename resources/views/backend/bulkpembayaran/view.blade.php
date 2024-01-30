@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Data Bulk Pembayaran') }} 
			  
			  <h5>Data Klaim</h5>
			  <div class="col-md-12">
			  <div class="form-group">
			    <div class="field_wrapper" id="formdp">
			  
						<table class="table table-bordered" width="100%">
							<thead>
							<tr>
							<th>{{ _lang('ID Claim') }}</th>
							<th>{{ _lang('No Verifikasi') }}</th>
							<th>{{ _lang('Distributor') }}</th>
							<th>{{ _lang('No Surat Claim Distributor') }}</th>
							<th>{{ _lang('No Rekening Distributor') }}</th>
							<th>{{ _lang('Cost Center') }}</th>
							<th>{{ _lang('No AP') }}</th>
							<th>{{ _lang('Nilai Klaim') }}</th>
							<th>{{ _lang('Total Realisasi') }}</th>	
							<th width="10%">Note Approval</th>
							</tr>
							</thead>
							<tbody>
							@foreach($appz as $appz)
								<tr>
									<td class='id'>{{ $appz->id }}
									<input type="hidden" class="form-control" name="idd" value="{{ $appz->distributor_id }}" >
									</td>
									<td class='name'>{{ $appz->nomor }}</td>
									<td class='distributor_id'>{{ isset($appz->distributor_id) ? $appz->distributor_name->name : '' }}</td>
									<td class='price'>{{ $appz->surat_jalan }}</td>
									<td class='price'>{{ $appz->bank_name->nama_bank }} <br> {{ $appz->no_rek.' ('.$appz->nama_rek.')'  }}</td>
									<td class='promo_id'>{{ isset($appz->cost_id) ? $appz->cost_name->cost_number : '' }}</td>
									<td class='no_ap'>{{ isset($appz->no_ap) ? $appz->no_ap : '' }}</td>
									<td class='price'>{{ 'Rp. '.decimalPlace($appz->nominal) }}</td>
									<td class='merus'>{{ 'Rp. '.decimalPlace($appz->dpp + $appz->ppn - $appz->pph) }}</td>						
									<td width='30%'>{{ $appz->appz->note_acc }}</td>								
								</tr>
							@endforeach
							</tbody>
						</table>
				   </div>    
				</div>  				   
		   </div><br>
		   <!--
		    <div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Total Pembayaran').' ('.currency().') Exclude Ppn' }}</label>						
				<input type="text" class="form-control total" name="nominal" value="{{ old('nominal') }}" readonly>
			  </div>
			</div>
			-->
			<div class="col-md-12">
			<div class="form-group">
										<label for=""> Tanggal Pembayaran</label>
										<h5>{{ $spr->created_at }}</h5>
								</div>
			<div class="form-group">
								
			</div>
@endsection


