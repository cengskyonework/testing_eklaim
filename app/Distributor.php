<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
     protected $table = 'distributor';
	 
	public function bank(){
		return $this->belongsTo('App\Bank','bank_id');
	}
	
	public function region(){
		return $this->belongsTo('App\Region','region_id');
	}
	
	public function created_name(){
		return $this->belongsTo('App\User','created_by');
	}
	
	public function created_nams(){
		return $this->belongsTo('App\User','created_by');
	}
	
	public function upd_name(){
		return $this->belongsTo('App\User','updated_by');
	}
	
}
