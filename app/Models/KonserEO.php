<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonserEO extends Model
{
    use HasFactory;
    protected $table = 'konser_eo';
    protected $fillable = [
        'id_eo',
        'jum_tiket',
        'foto',
        'judul',
        'waktu',
        'desk',
        'link_leve_konser',
    ];

     public function eo(){
        return $this->belongsTo(EO::class, 'id_eo') ;
    }
}
