@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Data Distributor') }}</h4>

			  <table class="table table-bordered">
				<tr><td colspan="2" ><strong>{{ _lang('Data Utama') }}</strong></td></tr>
				<tr><td style="width:200px;">{{ _lang('No Distributor') }}</td><td>{{ $distributor->no_distributor }}</td></tr>
				<tr><td>{{ _lang('Nama Distributor') }}</td><td>{{ $distributor->name }}</td></tr>
				<tr><td>{{ _lang('No Identitas') }}</td><td>{{ $distributor->id_no }}</td></tr>
				<tr><td>{{ _lang('Telp / Hp') }}</td><td>{{ $distributor->hp }}</td></tr>
				<tr><td>{{ _lang('Email') }}</td><td>{{ $distributor->email }}</td></tr>
				<tr><td>{{ _lang('Alamat') }}</td><td>{{ $distributor->address }}</td></tr>
				<tr><td>{{ _lang('NPWP') }}</td><td>{{ $distributor->npwp }}</td></tr>
				<tr><td>{{ _lang('Keterangan') }}</td><td>{{ $distributor->keterangan }}</td></tr>
				<tr><td>{{ _lang('Area Distributor') }}</td><td>{{ $distributor->region->region_city }}</td></tr>
				<tr><td colspan="2" ><strong>{{ _lang('Data Pembayaran') }}</strong></td></tr>
				<tr><td>{{ _lang('Nama Bank') }}</td><td>{{ $distributor->bank->nama_bank }}</td></tr>
				<tr><td>{{ _lang('No Rek') }}</td><td>{{ $distributor->no_rek }}</td></tr>
				<tr><td>{{ _lang('A/N Rekening') }}</td><td>{{ $distributor->nama_rek }}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>                        
@endsection


