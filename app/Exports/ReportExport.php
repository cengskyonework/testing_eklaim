<?php

namespace App\Exports;

use App\Claim;
use App\ClaimFlowDokumen;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements  FromCollection, WithHeadings, ShouldAutoSize, WithMapping
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
										"claim_produk.produk_id",
										"claim_produk.nilai",
										"claim_produk.qty",
										"claim_produk.dpp as dppx",
										"claim_produk.ppn as ppnx",
										"claim_produk.pph as pphx",
										"claim_approval.status",
										"claim_approval.status2",
										"claim_approval.status3",
										"claim_approval.status4",
										"claim_approval.status5",
										"claim_approval.approved_1_date",
										"claim_approval.approved_2_date",
										"claim_approval.approved_3_date",
										"claim_approval.approved_4_date",
										"claim_approval.approved_5_date",
										"claim_flow_document.tanggal_kirim_acc",
										"claim_flow_document.tanggal_terima_acc",
										"claim_flow_document.tanggal_kirim_fat",
										"claim_flow_document.tanggal_terima_fat",
										"claim_flow_document.note_balik_acc",
										"claim_flow_document.acc_terima",
										// tambahan
										"claim_flow_document.fat_pending",
										"claim_flow_document.note_balik_fat",
										"claim_flow_document.acc_pending",
										"claim_flow_document.note_balik_acc",
										// tambahan										
										"produk.nama as nama_produk",
										"produk.kode as kode_produk",
										"produk.category",
									])
									->join('claim_produk', 'claim_produk.claim_id', 'claim.id')
									 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
									 ->join('claim_approval', 'claim_approval.claim_id', 'claim.id')
									->join('produk', 'claim_produk.produk_id', 'produk.id')
									->whereBetween('claim.created_at', [$from, $to2])
									->whereIn('claim.cost_id', $sts)
									->whereIn('claim.distributor_id', $sta)
									->with('acc_name')
									->get();
			}
			else
			{
				$query = Claim::select([	
										"claim.*",
										"claim.status as status_ku",
										"claim_produk.produk_id",
										"claim_produk.nilai",
										"claim_produk.qty",
										"claim_produk.dpp as dppx",
										"claim_produk.ppn as ppnx",
										"claim_produk.pph as pphx",
										"claim_approval.status",
										"claim_approval.status2",
										"claim_approval.status3",
										"claim_approval.status4",
										"claim_approval.status5",
										"claim_approval.approved_1_date",
										"claim_approval.approved_2_date",
										"claim_approval.approved_3_date",
										"claim_approval.approved_4_date",
										"claim_approval.approved_5_date",
										"claim_flow_document.tanggal_kirim_acc",
										"claim_flow_document.tanggal_terima_acc",
										"claim_flow_document.tanggal_kirim_fat",
										"claim_flow_document.tanggal_terima_fat",
										"claim_flow_document.note_balik_acc",
										"claim_flow_document.acc_terima",
										// tambahan
										"claim_flow_document.fat_pending",
										"claim_flow_document.note_balik_fat",
										"claim_flow_document.acc_pending",
										"claim_flow_document.note_balik_acc",
										// tambahan
										"produk.nama as nama_produk",
										"produk.kode as kode_produk",
										"produk.category",
									])
									->join('claim_produk', 'claim_produk.claim_id', 'claim.id')
									 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
									 ->join('claim_approval', 'claim_approval.claim_id', 'claim.id')
									->join('produk', 'claim_produk.produk_id', 'produk.id')
									->whereBetween('claim.created_at', [$from, $to2])
									->whereIn('claim.cost_id', $sts)
									->with('acc_name')
									->get();
			}
            
        }
		else
		{
			$sta = [$this->params->distributor_id];
			
			if ($this->params->distributor_id != 'all') {
				$query = Claim::select([	
										"claim.*",
										"claim.status as status_ku",
										"claim_produk.produk_id",
										"claim_produk.nilai",
										"claim_produk.qty",
										"claim_produk.dpp as dppx",
										"claim_produk.ppn as ppnx",
										"claim_produk.pph as pphx",
										"claim_approval.status",
										"claim_approval.status2",
										"claim_approval.status3",
										"claim_approval.status4",
										"claim_approval.status5",
										"claim_approval.approved_1_date",
										"claim_approval.approved_2_date",
										"claim_approval.approved_3_date",
										"claim_approval.approved_4_date",
										"claim_approval.approved_5_date",
										"claim_flow_document.tanggal_kirim_acc",
										"claim_flow_document.tanggal_terima_acc",
										"claim_flow_document.tanggal_kirim_fat",
										"claim_flow_document.tanggal_terima_fat",
										"claim_flow_document.note_balik_acc",
										// tambahan
										"claim_flow_document.fat_pending",
										"claim_flow_document.note_balik_fat",
										"claim_flow_document.acc_pending",
										"claim_flow_document.note_balik_acc",
										// tambahan
										"produk.nama as nama_produk",
										"produk.kode as kode_produk",
										"produk.category",
										"claim_flow_document.acc_terima",
									])
									->join('claim_produk', 'claim_produk.claim_id', 'claim.id')
									 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
									 ->join('claim_approval', 'claim_approval.claim_id', 'claim.id')
									->join('produk', 'claim_produk.produk_id', 'produk.id')
									->whereBetween('claim.created_at', [$from, $to2])
									->whereIn('claim.distributor_id', $sta)
									->with('acc_name')
									->get();
			}
			else
			{
				$query = Claim::select([	
										"claim.*",
										"claim.status as status_ku",
										"claim_produk.produk_id",
										"claim_produk.nilai",
										"claim_produk.qty",
										"claim_produk.dpp as dppx",
										"claim_produk.ppn as ppnx",
										"claim_produk.pph as pphx",
										"claim_approval.status",
										"claim_approval.status2",
										"claim_approval.status3",
										"claim_approval.status4",
										"claim_approval.status5",
										"claim_approval.approved_1_date",
										"claim_approval.approved_2_date",
										"claim_approval.approved_3_date",
										"claim_approval.approved_4_date",
										"claim_approval.approved_5_date",
										"claim_flow_document.tanggal_kirim_acc",
										"claim_flow_document.tanggal_terima_acc",
										"claim_flow_document.tanggal_kirim_fat",
										"claim_flow_document.tanggal_terima_fat",
										"claim_flow_document.note_balik_acc",
										// tambahan
										"claim_flow_document.fat_pending",
										"claim_flow_document.note_balik_fat",
										"claim_flow_document.acc_pending",
										"claim_flow_document.note_balik_acc",
										// tambahan
										"produk.nama as nama_produk",
										"produk.kode as kode_produk",
										"produk.category",
										"claim_flow_document.acc_terima",
									])
									->join('claim_produk', 'claim_produk.claim_id', 'claim.id')
									 ->join('claim_flow_document', 'claim_flow_document.claim_id', 'claim.id')
									 ->join('claim_approval', 'claim_approval.claim_id', 'claim.id')
									->join('produk', 'claim_produk.produk_id', 'produk.id')
									->whereBetween('claim.created_at', [$from, $to2])
									->with('acc_name')
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
			'Wilayah Program',
			'Periode Start',
			'Periode End',
			'Thn Promo',
			'Kode Produk',
			'Produk',
			'Kategori Produk ',
			'Qty',
			'Deskripsi Cost Center',
			'Area',
			'Nilai klaim dari Distributor (Exclude PPn)',
			'Nilai Realisasi Accounting (DPP)',
			'No Rekening',
			'A/N Rekening',
			'Nama Bank',
			'Status Pembayaran',
			'Cost Center',
			'Tanggal Konfirmasi Admin',
			// tambah
			'Tanggal Pending Fin',
			'Note Pending Fin',
			'Tanggal pending Acc',
			'Note Pending Acc',
			// tambah
			'Tanggal Update Terakhir',
			'Tanggal Approval 1',
			'Tanggal Approval 2',
			'Tanggal Approval 3',
			'Tanggal Approval 4',
			'Tanggal Approval 5',
			'Tanggal Kirim Ke Acc',
			'Tanggal Terima Acc',
			'Tanggal Kirim Ke Fin',
			'Tanggal Terima Fin',
			'Tanggal Pembayaran',
			'Note Perubahan Admin',
			'Note Perubahan Konfirmasi Cost Center',
			'Perubahan oleh siapa',
			'No AP',
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
            $row->promox['name'],
			$row->promox['wilayah'],
			date('d-m-Y', strtotime($row->periode_start)),
			date('d-m-Y', strtotime($row->periode_end)),
			date('Y', strtotime($row->created_at)),
			$row->kode_produk,
			$row->nama_produk,
			$row->category,
			$row->qty,
			$row->promo->chanel_name,
			$row->region_name->region_city,
			$row->nilai,
			(($row->dppx + $row->ppnx) - $row->pphx),
			str_replace('.','',$row->no_rek),
			$row->nama_rek,
			$row->bank_name->nama_bank,
			$row->appz->status_finance == 3 ? 'Dipotong dana pembentukan HCO' : ($row->admin_date == null ? 'Claim Baru' : klaimi_status($row->status_ku)),
			$row->cost_id != null ? $row->cost_name->cost_number : '',
			$row->admin_date == null ? '' : date('d-m-Y', strtotime($row->admin_date)),
			// tambahan
			$row->fat_pending,
			$row->note_balik_fat,
			$row->fat_acc,
			$row->note_balik_acc,
			// tambahan
			$row->updated_at == $row->created_at ? '' : date('d-m-Y', strtotime($row->updated_at)),
			$row->status == 3 ? '' : ($row->approved_1_date == null ? '' : date('d-m-Y', strtotime($row->approved_1_date))),
			$row->status == 3 ? '' : ($row->approved_2_date == null ? '' : date('d-m-Y', strtotime($row->approved_2_date))),
			$row->status == 3 ? '' : ($row->approved_3_date == null ? '' : date('d-m-Y', strtotime($row->approved_3_date))),
			$row->status == 3 ? '' : ($row->approved_4_date == null ? '' : date('d-m-Y', strtotime($row->approved_4_date))),
			$row->status == 3 ? '' : ($row->approved_5_date == null ? '' : date('d-m-Y', strtotime($row->approved_5_date))),
			$row->tanggal_kirim_acc == null ? '' : date('d-m-Y', strtotime($row->tanggal_kirim_acc)),
			$row->tanggal_terima_acc == null ? '' : date('d-m-Y', strtotime($row->tanggal_terima_acc)),
			$row->tanggal_kirim_fat == null ? '' : date('d-m-Y', strtotime($row->tanggal_kirim_fat)),
			$row->tanggal_terima_fat == null ? '' : date('d-m-Y', strtotime($row->tanggal_terima_fat)),
			$row->pay_date,
			$row->note_admin_lagi,
			$row->note_perubahan,
			$row->note_perubahan != null ? $row->upd_name->name : '',
			$row->no_ap,
        ];
    }
}
