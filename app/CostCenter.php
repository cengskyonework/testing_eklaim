<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $table = 'costcenter';
	
	protected $fillable = ['cost_number','cost_name','cost_code','chanel_id','appv1','appv2','appv3','status'];
	
	public function namaapp1(){
		return $this->belongsTo('App\User','appv1');
	}
	
	public function chanel(){
		return $this->belongsTo('App\Channel','chanel_id');
	}
	
	public function namaapp2(){
		return $this->belongsTo('App\User','appv2');
	}
	
	public function namaapp3(){
		return $this->belongsTo('App\User','appv3');
	}
	
	public function namaapp4(){
		return $this->belongsTo('App\User','appv4');
	}
	
	public function namaapp5(){
		return $this->belongsTo('App\User','appv5');
	}
	
	public function namaapp6(){
		return $this->belongsTo('App\User','appv6');
	}
	
	public function namaapp7(){
		return $this->belongsTo('App\User','appv7');
	}
	
	public function namaapp8(){
		return $this->belongsTo('App\User','appv8');
	}
	
	public function namaapp9(){
		return $this->belongsTo('App\User','appv9');
	}
	
	public function namaapp10(){
		return $this->belongsTo('App\User','appv10');
	}
}
