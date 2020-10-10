<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'no_hp',
        'api_token',
        'id_level',
        'verifikasi_akun',
        'verifikasi_token',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'verifikasi_token',
        'api_token',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function level(){
        return $this->belongsTo(Level::class, 'id_level') ;
    }

    public function penonton(){
        return $this->hasOne(Penonton::class, 'id_user') ;
    }

    public function artis(){
        return $this->hasOne(Artis::class, 'id_user') ;
    }

    public function eo(){
        return $this->hasOne(EO::class, 'id_user') ;
    }
}
