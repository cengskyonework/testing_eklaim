@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Data Klaim') }} @if ($spr->status == 'A') <span class="badge badge-primary">On Progress</span> 
			  @elseif($spr->status == 'B') 
				@if($spr->flag_acc == 2)
					<span class="badge badge-success">Pengiriman Data Ke Accounting</span> 
				@elseif($spr->flag_acc == 3)
					<span class="badge badge-success">Konfirmasi Accounting</span>
				@elseif($spr->flag_acc == 4) 
					<span class="badge badge-success">Pengiriman Data Ke Finance</span>
				@elseif($spr->flag_acc == 5)
					<span class="badge badge-success">Konfirmasi Finance</span>
				@endif
			  @elseif($spr->status == 'C') <span class="badge badge-success">Klaim Dibayarkan</span>	
			  @elseif($spr->status == 'P') <span class="badge badge-dark">Klaim DiPending</span>
			  @elseif($spr->status == 'T') <span class="badge badge-danger">Klaim Tidak Dibayarkan</span>			  
			  @else <span class="badge badge-danger">Ditolak</span> @endif</h4>
			  <h5>Data Klaim</h5>
			  <table class="table table-bordered">
				<tr><td style="width:250px;">{{ _lang('Nomor Verifikasi') }}</td><td>{{ $spr->nomor }} </td></tr>
				<tr><td>{{ _lang('Nama Konsumen') }}</td><td>{{ isset($spr->distributor_id) ? $spr->distributor_name->name : '' }}</td></tr>
				<tr><td>{{ _lang('No Identitas') }}</td><td>{{ $spr->distributor_name->id_no }}</td></tr>
				<tr><td>{{ _lang('No Telepon / HP') }}</td><td>{{ $spr->distributor_name->hp }}</td></tr>
				<tr><td>{{ _lang('Email') }}</td><td>{{ $spr->distributor_name->email }}</td></tr>
				<tr><td>{{ _lang('NPWP') }}</td><td>{{ $spr->distributor_name->npwp }}</td></tr>
				<tr><td>{{ _lang('Alamat') }}</td><td>{{ $spr->distributor_name->address }}</td></tr>
			  </table>
			  <br>
			  <h5>Data Produk</h5>
			  <table class="table table-bordered">			  
				<tr><td align="center">Nama Produk</td><td align="center">Jumlah</td></tr>		
				@foreach($produk as $item)
				<tr><td align="center" >{{ $item->nama }}</td><td align="center" class="isi">{{ 'Rp.'.number_format($item->nilai) }}</td></tr>
				@endforeach
				<tr><td><b>Total Klaim (Rp)</b></td><td align="center" class="isi"><b>{{ 'Rp.'.number_format($spr->nominal) }}</b></td></tr>
			  </table>
			  <br>
			  <h5>Data Dokumen</h5>
			  <table class="table table-bordered">
				<table class="table table-bordered">			  
				<tr><td align="center">Nama Dokumen</td><td align="center">Nama File</td></tr>		
				@foreach($dokumen as $item)
				<tr><td align="center" >{{ $item->name }}</td><td align="center" class="isi"> {{ $item->nama_document }}</td></tr>
				@endforeach
			  </table>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


