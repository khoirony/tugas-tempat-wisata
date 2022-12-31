<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function komentar() 
	{
		return $this->hasMany('App\Models\Komentar', 'id_tempat');
	}

	public function favorite() 
	{
		return $this->hasMany('App\Models\Favorite', 'id_tempat');
	}

    public function fototempat() 
	{
		return $this->hasMany('App\Models\FotoTempat', 'id_tempat');
	}
}
