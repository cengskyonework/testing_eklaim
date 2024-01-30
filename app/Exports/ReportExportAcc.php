<?php

namespace App\Exports;

use App\Claim;
use App\ClaimFlowDokumen;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExportAcc implements  FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
	use Exportable;
	
	protected $params;

    public function __construct(array $params) {
        $this->params = (object) $params;
    }
	
    public function collection()
    {
		if ($this->params->start_date && $this->params->end_date) {
            $from = $this->params->start_date;
			$to = $this->params->end_date;
			
			$to2 =	date('Y-m-d', strtotime('+1 days', strtotime($to)));
        }
		else {
			$from = '1970-01-01';
			$to = date('Y-m-d');
			
			$to2 =	date('Y-m-d', strtotime('+1 days', strtotime($to)));
		}
		
		if ($this->params->cost_id != 'all') {
            
            $sts = [$this->params->cost_id];
			$sta = [$this->params->distributor_id];

			if ($this->params->distributor_id != 'all') {
					$query = Claim::select([	
											"claim.*",
											"claim.status as status_ku",
											"claim_flow_document.tanggal_kirim_acc",
											"claim_flow_document.tanggal_terima_acc",
											"claim_flow_document.tanggal_kirim_fat",
											"claim_flow_document.tanggal_terima_fat",
											"claim_flow_document.note_balik_acc",
											"claim_flow_document.acc_terima",
											"users.name",
										])
										 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
										 ->join('users', 'claim_flow_document.acc_terima', 'users.id')
										->whereBetween('claim.created_at', [$from, $to2])
										->whereIn('claim.cost_id', $sts)
										->whereIn('claim.distributor_id', $sta)
										->get();
			}
			else
			{
				$query = Claim::select([	
											"claim.*",
											"claim.status as status_ku",
											"claim_flow_document.tanggal_kirim_acc",
											"claim_flow_document.tanggal_terima_acc",
											"claim_flow_document.tanggal_kirim_fat",
											"claim_flow_document.tanggal_terima_fat",
											"claim_flow_document.note_balik_acc",
											"claim_flow_document.acc_terima",
											"users.name",
										])
										 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
										 ->join('users', 'claim_flow_document.acc_terima', 'users.id')
										->whereBetween('claim.created_at', [$from, $to2])
										->whereIn('claim.cost_id', $sts)
										->get();
				
			}
								
		}
		else {
			
			$sta = [$this->params->distributor_id];

			if ($this->params->distributor_id != 'all') {
					$query = Claim::select([	
											"claim.*",
											"claim.status as status_ku",
											"claim_flow_document.tanggal_kirim_acc",
											"claim_flow_document.tanggal_terima_acc",
											"claim_flow_document.tanggal_kirim_fat",
											"claim_flow_document.tanggal_terima_fat",
											"claim_flow_document.note_balik_acc",
											"claim_flow_document.acc_terima",
											"users.name",
										])
										 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
										 ->join('users', 'claim_flow_document.acc_terima', 'users.id')
										->whereBetween('claim.created_at', [$from, $to2])
										->whereIn('claim.distributor_id', $sta)
										->get();
			}
			else
			{
					$query = Claim::select([	
											"claim.*",
											"claim.status as status_ku",
											"claim_flow_document.tanggal_kirim_acc",
											"claim_flow_document.tanggal_terima_acc",
											"claim_flow_document.tanggal_kirim_fat",
											"claim_flow_document.tanggal_terima_fat",
											"claim_flow_document.note_balik_acc",
											"claim_flow_document.acc_terima",
											"users.name",
										])
										 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
										 ->join('users', 'claim_flow_document.acc_terima', 'users.id')
										->whereBetween('claim.created_at', [$from, $to2])
										->get();
				
			}
					
		}
        return ($query);
    }
    
    

    public function headings(): array
    {
        return [
            'No',
            'Verification Number',
            'Jenis Klaim',
			'Date Created',
			'No Distributor',
            'Distributor Name',
			'No Surat Program ',
            'No Surat klaim Distributor',
            'Nama Program',
			'Periode Start',
			'Periode End',
			'Thn Promo',
			'Deskripsi Cost Center',
			'Area',
			'Nilai klaim dari Distributor (Exclude PPn)',
			'Nilai Realisasi Accounting (DPP)',
			'Nilai Realisasi Accounting (PPN)',
			'Nilai Realisasi Accounting (Pph)',
			'Total Realisasi',
			'No Rekening',
			'A/N Rekening',
			'Nama Bank',
			'Status Pembayaran',
			'Cost Center',
			'Tanggal Kirim Ke Acc',
			'Tanggal Terima Acc',
			'Tanggal Kirim Ke Fin',
			'Tanggal Terima Fin',
			'Tanggal Pembayaran',
			'Note Perubahan',
			'Perubahan oleh siapa',
			'No AP',
			'Note Finance',
        ];
    }
	
	function map($row): array
    {
        return [
            $row->id,
			$row->nomor,
            $row->cat_name->name,
			date('d-m-Y', strtotime($row->created_at)),
			$row->distributor_name->no_distributor,
			$row->distributor_name->name,
			$row->no_surat,
            $row->surat_jalan,
            $row->promox->name,
			date('d-m-Y', strtotime($row->periode_start)),
			date('d-m-Y', strtotime($row->periode_end)),
			date('Y', strtotime($row->created_at)),
			$row->promo->chanel_name,
			$row->region_name->region_city,
			$row->nominal,
			$row->dpp,
			$row->ppn,
			$row->pph,
			(($row->dpp + $row->ppn) - $row->pph),
			str_replace('.','',$row->no_rek),
			$row->nama_rek,
			$row->bank_name->nama_bank,
			$row->appz->status_finance == 3 ? 'Dipotong dana pembentukan HCO' : ($row->admin_date == null ? 'Claim Baru' : klaimi_status($row->status_ku)),
			$row->cost_id != null ? $row->cost_name->cost_number : '',
			$row->tanggal_kirim_acc == null ? '' : date('d-m-Y', strtotime($row->tanggal_kirim_acc)),
			$row->tanggal_terima_acc == null ? '' : date('d-m-Y', strtotime($row->tanggal_terima_acc)),
			$row->tanggal_kirim_fat == null ? '' : date('d-m-Y', strtotime($row->tanggal_kirim_fat)),
			$row->tanggal_terima_fat == null ? '' : date('d-m-Y', strtotime($row->tanggal_terima_fat)),
			$row->pay_date,
			$row->appz->note_finance,
			$row->appz->note_finance != null ? $row->name : '',
			$row->no_ap,
			$row->appz->note_acc,
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'N' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
