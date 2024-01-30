<?php

namespace App\Imports;

use App\CostCenter;
use App\Channel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CostImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		$cek = CostCenter::Where('cost_number','=',$row['nomor'])->count();
		
		if ($cek == 0)
		{
			return new CostCenter([
				'cost_number' => $row['nomor'],
				'cost_name' => $row['nama'], 
				'cost_code' => $row['kode'], 
				'chanel_id' => Channel::where('chanel_name', $row['deskripsi'])->first()->id,
				'status' => 'A',
			]);
		}
    }
}
