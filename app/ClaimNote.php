<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimNote extends Model
{
    protected $table = 'claim_admin_history';
	
	public function admin(){
		return $this->belongsTo('App\User','created_by');
	}
}
