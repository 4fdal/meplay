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
        'waktu_mulai',
        'waktu_selesai',
        'desk',
        'link_live_konser',
    ];

     public function eo(){
        return $this->belongsTo(EO::class, 'id_eo') ;
    }
}
