<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Claim extends Model
{
	use Sortable;
	
	protected $fillable = ['id', 'nomor', 'status'];

	public $sortable = ['id', 'nomor', 'status'];
	
    protected $table = 'claim';
	
	
	public function promo(){
		return $this->belongsTo('App\Channel','promo_id');
	}
	public function promox(){
		return $this->belongsTo('App\Promo','promo_idx');
	}
	
	public function distributor_name(){
		return $this->belongsTo('App\Distributor','distributor_id');
	}
	
	public function region_name(){
		return $this->belongsTo('App\Region','region_id');
	}
	
	public function cost_name(){
		return $this->belongsTo('App\CostCenter','cost_id');
	}
	
    public function cat_name(){
		return $this->belongsTo('App\Category','category_id');
	}
	
	public function acc_name(){
		return $this->belongsTo('App\User','acc_terima');
	}
	
	public function upd_name(){
		return $this->belongsTo('App\User','updated_by');
	}
	
	public function crt_name(){
		return $this->belongsTo('App\User','created_by');
	}
	
	public function bank_name(){
		return $this->belongsTo('App\Bank','bank_id');
	}
	
	public function approval(){
		return $this->belongsTo('App\ClaimFlowDokumen','id','claim_id');
	}
	
	public function appz(){
		return $this->belongsTo('App\ClaimApproval','id','claim_id');
	}

	
}
