<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tanda Terima</title>
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
			border-collapse: collapse;
		}
		td {
		  height: 30px;
		  font-size:10px;
		  text-align: center;
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
				<table width="100%">
							<tr>
							  <td align="center" colspan="7"><h2><b>TANDA TERIMA</b></h2></td>
							</tr>
				</table>
				<table width="100%" border="0.5px">
							<tr>
							  <td>No</td>
							  @if((Auth::user()->user_type == 'accounting') || (Auth::user()->user_type == 'admin'))
								<td>Tanggal Terima (Acct dari Admin)</td>
							  @else
								<td>Tanggal Approval Final</td>
							  @endif
							  <td>ID Claim</td>
							  <td>Nomor Verifikasi</td>
							  <td>Nomor Surat Program</td>
							  <td>Nomor Surat Claim<br> Distributor</td>
							  <td>Nama Distributor</td>
							  <td>Nama Program</td>
							  <td>Dpp Pengajuan Dist. (Rp)</td>
							  @if((Auth::user()->user_type == 'accounting') || (Auth::user()->user_type == 'admin'))
							  <td>Dpp Versi Acc. (Rp)</td>
							  <td>PPN. (Rp)</td>
							  <td>Nomor AP</td>							  
							  @endif
							  <td>Tanggal Penyerahan</td>
							</tr>
								<tr>
								  <td>1.</td>
								  <td>
								  @if((Auth::user()->user_type == 'accounting') || (Auth::user()->user_type == 'admin'))
										@if(!empty($spr->approval->tanggal_terima_acc)) {{ date("d-m-Y", strtotime($spr->approval->tanggal_terima_acc)) }} @endif
								  
								  @else
									@foreach ($app as $item)
										@php
												if($item->approved_3_date == NULL)
												{
													if($item->approved_2_date == NULL) 
													{		$xapp = $item->approved_1_date; }
													else
													{		$xapp = $item->approved_2_date; }
												}
												else
													{		$xapp = $item->approved_3_date;	}
										@endphp
										@endforeach
											{{ date("d-m-Y", strtotime($xapp)) }} 
							      @endif
								  </td>
								  <td>{{ $spr->id }}</td>
								  <td>{{ $spr->nomor }}</td>
								  <td>{{ $spr->no_surat }}</td>
								  <td>{{ $spr->surat_jalan }}</td>
								  <td>{{ $spr->distributor_name->name }}</td>
								  <td>{{ $spr->promox->name }}</td>
								  <td>{{ number_format($spr->nominal,2) }}</td>
								  @if((Auth::user()->user_type == 'accounting') || (Auth::user()->user_type == 'admin'))
								  <td>{{ number_format($spr->dpp,2) }}</td>
								  <td>{{ number_format($spr->ppn,2) }}</td>
								  <td>{{ $spr->no_ap }}</td>  
								  @endif
								  <td>
								  @if((Auth::user()->user_type == 'accounting') || (Auth::user()->user_type == 'admin'))
										@if(!empty($spr->approval->tanggal_kirim_fat)) {{ date("d-m-Y", strtotime($spr->approval->tanggal_kirim_fat)) }} @endif
								  @else
										@if(!empty($spr->approval->tanggal_kirim_acc)) {{ date("d-m-Y", strtotime($spr->approval->tanggal_kirim_acc)) }} @endif
								  @endif
								  </td>
								</tr>
						
				</table><br>
				<table width="100%" class="table-bordered">
							<tr>
							<td width="25%">DISERAHKAN OLEH :</td>
							<td width="50%"></td>
							<td width="25%">DITERIMA OLEH :</td>
							</tr>
							<tr>
							<td class="kotak"></td>
							<td></td>
							<td class="kotak"></td>
				
							</tr>
				</table>				
			</div>
	    </div>
	</div>
</div>
</body>
</html>


