<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EO extends Model
{
    use HasFactory;
    protected $table = 'eo';
    protected $fillable = [
        'id_user',
        'foto',
        'foto_ktp',
        'nama',
        'alamat',
    ];
    public function user(){
        return $this->belongsTo(Level::class, 'id_user') ;
    }
}
