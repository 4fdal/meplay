<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketDibeli extends Model
{
    use HasFactory;

    public static  $DIBELI_STAT_TUNGGU_PEMBAYARAN = 1 ; 
    public static  $DIBELI_STAT_SEDANG_VERIFIKASI = 2 ; 
    public static  $DIBELI_STAT_SELESAI = 3 ; 

    public static  $STAT_BELUM_DIGUNAKAN = 0 ; 
    public static  $STAT_TELAH_DIGUNAKAN = 1 ; 

    protected $table = 'tiket_dibeli';
    protected $fillable = [
        'id_tiket',
        'id_penonton',
        'id_konser_eo',
        'jum_replay',
        'waktu_dibeli',
        'exp_waktu_replay',
        'total_harga',
        'status_dibeli',
        'status_penggunaan',
    ];
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton') ;
    }
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
}
