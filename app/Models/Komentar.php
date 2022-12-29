<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user() 
	{
		return $this->belongsTo('App\Models\User', 'id_user');
	}

    public function tempat() 
	{
		return $this->belongsTo('App\Models\Tempat', 'id_tempat');
	}
}
