<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAkses extends Model
{
    protected $table = 'user_akses';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['user_id'];
	
	public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
	
	public function userin()
    {
        return $this->hasOne('App\User');
    }
	
	public function costname(){
		return $this->belongsTo('App\CostCenter','cost_id');
	}
}
