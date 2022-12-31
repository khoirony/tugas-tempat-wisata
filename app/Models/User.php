<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function komentar() 
	{
		return $this->HasMany('App\Models\Komentar', 'id_user');
	}

    public function favorite() 
	{
		return $this->HasMany('App\Models\Favorite', 'id_user');
	}
}
