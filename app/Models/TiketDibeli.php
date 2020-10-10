<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketDibeli extends Model
{
    use HasFactory;
    protected $table = 'tiket_dibeli';
    protected $fillable = [
        'id_penonton',
        'id_konser_eo',
        'jum_pembayaran',
        'status_penggunaan',
        'exp_pembatalan',
    ];
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton') ;
    }
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
}
