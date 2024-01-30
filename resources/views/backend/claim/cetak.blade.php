<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Verifikasi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family: "Book Antiqua";
            color:#333;
            text-align:left;
            font-size:16px;
            margin:0;
        }
		table {
		
		}
		td {
		  height: 20px;
		  font-size:11px;
		}
		.nominal
		{
		   height: 35px;
		   color: white;
		}
		.kotak
		{
		   height: 60px;
		   border-bottom: 1pt solid black;
		}
		.tanggal
		{
		   border-bottom: 1pt solid black;
		}
		.bold
		{
			font-weight: bold;
			
		}
		
		img {
			  max-height: 350px;
			  max-width: 250px;
			  padding-top:0.5ex
			  vertical-align: middle;
			}
    </style>
</head>
<body>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table width="100%" style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;" >
							<tr>
							  <td width="10%"></td>
							  <td width="20%" colspan="2" align="left">PT. NIRAMAS UTAMA</td>
							  <td width="20%" colspan="2"></td>							  
							  <td width="20%"align="right">Cost Center</td>
							  <td width="20%">{{ $spr->cost_name->cost_number }}</td>
							</tr>
							<tr>
							  <td align="center" colspan="7"><b>PERMINTAAN PEMBAYARAN</b></td>
							</tr>
							<tr>
							  <td width="10%" align="right">ID : {{ $spr->id }}</td>
							  <td width="20%" align="right">Nomor Verifikasi :</td>
							  <td width="15%" colspan="2" align="left">{{ $spr->nomor }}</td>
							  <td width="15%"></td>
							  <td width="20%" align="right">Divisi :</td>
							  <td width="20%">{{ $spr->cost_name->cost_code }}</td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">Tanggal :</td>
							  <td colspan="2" align="left">{{ tgl_indo($spr->created_at) }}</td>
							  <td></td>
							  <td align="right">Nama :</td>
							  <td></td>
							</tr>
							</table>
							<table width="100%" style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;">
							<tr>
							  <td></td>
							  <td colspan="5">A. DATA DISTRIBUTOR</td>
							</tr>
							<tr>
							  <td></td>
							  <td width="10%" align="right">1.</td>
							  <td width="30%">Nama Distributor - Lokasi</td>
							  <td width="2%">:</td>
							  <td width="20%">{{ $spr->distributor_name->name .' - '. $spr->region_name->region_city }}</td>
							  <td width="35%"></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">2.</td>
							  <td>Nama Claim</td>
							  <td>:</td>
							  <td>{{ $spr->promox->name }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">3.</td>
							  <td>Periode Start</td>
							  <td>:</td>
							  <td>{{ $spr->periode_start }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right"></td>
							  <td>Periode End</td>
							  <td>:</td>
							  <td>{{ $spr->periode_end }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">4.</td>
							  <td>No Surat Claim</td>
							  <td>:</td>
							  <td>{{ $spr->surat_jalan }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">5.</td>
							  <td>No Surat Program</td>
							  <td>:</td>
							  <td>{{ $spr->no_surat }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">6.</td>
							  <td>No Rekening</td>
							  <td>:</td>
							  <td>{{ $spr->no_rek }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">7.</td>
							  <td>Nama Rekening</td>
							  <td>:</td>
							  <td>{{ $spr->nama_rek }}</td>
							  <td></td>
							  </tr>
							<tr>
							  <td></td>
							  <td align="right">8.</td>
							  <td>Nama Bank</td>
							  <td>:</td>
							  <td>{{ $spr->bank_name->nama_bank }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">9.</td>
							  <td>Total Pengajuan</td>
							  <td>:</td>
							  <td>{{ 'Rp.'.number_format($spr->nominal) }}</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">10.</td>
							  <td>Kelengkapan Dokumen</td>
							  <td>:</td>
							  <td colspan="2">
								 <table  class="display table-head-bg-primary datatables" width="100%">
								 <tr>
								 <td style="vertical-align:top">
									@foreach ($dokumen as $item)								
									@if ($loop->index%3 == 0 && $loop->index != 0)
									</td>
									<td style="vertical-align:top">
									@endif
									<table>
									<tr>				
										<td style="width:15px"><input type="checkbox" name="document_id[]" value="{{ $item->id }}" checked></td><td>{{ $item->name }}</td>
									</tr>
									</table>										
									@if ($loop->last)
									</td>
									@endif
									@endforeach
								 </tr>
								 </table>
							  </td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">11.</td>
							  <td>Catatan</td>
							  <td>:</td>
							  <td></td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">12.</td>
							  <td>Diajukan</td>
							  <td>:</td>
							  <td colspan="2">{{ $spr->distributor_name->name .' ('.tgl_indo($spr->created_at) .')' }}</td>
							</tr>
							@foreach ($app as $item)
							<tr>
							  <td></td>
							  <td align="right">13.</td>
							  <td>Diketahui</td>
							  <td>:</td>
							  <td colspan="2">
							  @if(!empty($item->approved_1))     
							      {{ $item->nama1->name .' ('. $item->approved_1_date .')'}}
							  @endif    
							 </td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">14.</td>
							  <td>Disetujui</td>
							  <td>:</td>
							  
							  <td colspan="2">
							    @if(!empty($item->approved_2))  
							      {{ $item->nama2->name .' ('. $item->approved_2_date .')'}}
							    @endif
								@if(!empty($item->approved_3))  
							      {{ $item->nama3->name .' ('. $item->approved_3_date .')'}}
							    @endif
							      </td>
							</tr>
							@endforeach
				</table>
				<table width="100%" style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;">
				<tr>
							  <td></td>
							  <td colspan="5">B. PEMERIKSAAN KLAIM</td>
							</tr>
							@foreach ($appz as $item)
							<tr>
							  <td></td>
							  <td width="10%" align="right">1.</td>
							  <td width="30%">Tanggal Terima</td>
							  <td width="2%">:</td>
							  <td width="20%">@if(!empty($item->tanggal_terima_acc)) {{ $item->tanggal_terima_acc }} @endif</td>
							  <td width="35%"></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">2.</td>
							  <td>Nama Pemeriksa</td>
							  <td>:</td>
							  <td>@if(!empty($item->acc_terima)) {{ $item->nama_admin_acc->name }} @endif</td>
							  <td></td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">3.</td>
							  <td>No Dokumen</td>
							  <td>:</td>
							  <td></td>
							  <td></td>
							</tr>
							@endforeach
							<tr>
							  <td></td>
							  <td align="right">4.</td>
							  <td>Nominal Koreksi</td>
							  <td>:</td>
							  <td colspan="2">
									<table width="70%" border="0.5" class="table table-bordered">			  
									<tr><td width="30%" align="center">DPP</td><td align="justify">{{ rupiah($spr->dpp) }}</td></tr>
									<tr><td align="center">PPN</td><td align="justify">{{ rupiah($spr->ppn) }}</td></tr>
									<tr><td align="center">Pph</td><td align="justify">{{ rupiah($spr->pph) }}</td></tr>									
									<tr><td align="center">TOTAL</td>
									<td align="justify" class="isi">
									    <b>{{ rupiah(($spr->dpp + $spr->ppn) - $spr->pph) }}</b>
									    </td>
									</tr>
								  </table>
							  </td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">5.</td>
							  <td>Kelengkapan Dokumen</td>
							  <td>:</td>
							  <td colspan="2">
								<table width="100%">
								<tr>
								  <td width="5%"><input type="checkbox" value=""></td>
								  <td width="30%" align="left">Kwitansi</td>
								  <td width="5%"><input type="checkbox" value=""></td>
								  <td width="40%" align="left">....................</td>
								</tr>
								<tr>
								  <td><input type="checkbox" value=""></td>
								  <td align="left">Faktur Pajak</td>
								  <td><input type="checkbox" value=""></td>
								  <td align="left">....................</td>
								</tr>
								</table>
							  </td>
							</tr>
							<tr>
							  <td></td>
							  <td align="right">6.</td>
							  <td>Catatan</td>
							  <td>:</td>
							  <td></td>
							  <td></td>
							</tr>
				</table>
				<table width="100%" class="table-bordered">
							<tr>
							<td></td>
							<td>DIPERIKSA OLEH :</td>
							<td>DIVERIFIKASI OLEH :</td>
							<td>PARK OLEH :</td>
							<td>POST OLEH :</td>
							<td>TAX VERIFICATOR :</td>
							</tr>
							<tr>
							<td class="kotak"></td>
							<td class="kotak"></td>
							<td class="kotak"></td>
							<td class="kotak"></td>
							<td class="kotak"></td>
							<td class="kotak"></td>
							</tr>
				</table>				
			</div>
	    </div>
	</div>
</div>
</body>
</html>


