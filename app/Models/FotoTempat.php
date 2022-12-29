<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoTempat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tempat() 
	{
		return $this->belongsTo('App\Models\Tempat', 'id');
	}
}
