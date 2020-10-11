<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penonton extends Model
{
    use HasFactory;
    protected $table = 'penonton';
    protected $fillable = [
        'id_user',
        'nama',
        'alamat',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user') ;
    }
}
