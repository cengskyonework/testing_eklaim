<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimFlowDokumen extends Model
{
    protected $table = 'claim_flow_document';
	
	public function nama_admin(){
		return $this->belongsTo('App\User','admin_kirim');
	}
	
	public function nama_admin_acc(){
		return $this->belongsTo('App\User','acc_terima');
	}
	
	public function nama_admin2_acc(){
		return $this->belongsTo('App\User','acc_kirim');
	}
	
	public function nama_admin_fat(){
		return $this->belongsTo('App\User','fat_terima');
	}
	
}
