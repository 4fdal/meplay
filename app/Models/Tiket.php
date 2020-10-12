<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $table = 'tiket';
    protected $fillable = [
        'id_konser_eo',
        'nama',
        'jumlah_tiket',
        'exp_waktu_pembelian',
        'harga',
        'harga_replay',
        'desk',
    ];
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
    public function tiketDibeli(){
        return $this->belongsTo(TiketDibeli::class, 'id_tiket');
    }
}
