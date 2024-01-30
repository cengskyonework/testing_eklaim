<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulkPembayaran extends Model
{
    protected $table = 'bulk_pembayaran';
	
	public function detail(){
		return $this->belongsTo('App\User','ClaimApproval');
	}

}
