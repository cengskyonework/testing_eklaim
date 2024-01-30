<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimDokumen extends Model
{
    protected $table = 'claim_dokument';
	
	public function nama(){
		return $this->belongsTo('App\Claim','claim_id');
	}

}
