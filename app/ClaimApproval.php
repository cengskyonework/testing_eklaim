<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimApproval extends Model
{
    protected $table = 'claim_approval';
	
	public function nama1(){
		return $this->belongsTo('App\User','approved_1');
	}
	
	public function nama2(){
		return $this->belongsTo('App\User','approved_2');
	}
	
	public function nama3(){
		return $this->belongsTo('App\User','approved_3');
	}
	
	public function nama_acc(){
		return $this->belongsTo('App\User','acc_appv');
	}
	
	public function nama_fat(){
		return $this->belongsTo('App\User','finance_appv');
	}

}
