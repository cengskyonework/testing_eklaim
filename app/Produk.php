<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
	protected $primaryKey = 'kode';
	protected $fillable = ['kode','nama','category','status'];
}