<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseArtisDibeli extends Model
{
    use HasFactory;

    public static  $DIBELI_STAT_TUNGGU_PEMBAYARAN = 1;
    public static  $DIBELI_STAT_SEDANG_VERIFIKASI = 2;
    public static  $DIBELI_STAT_SELESAI = 3;

    public static  $STAT_BELUM_DIGUNAKAN = 0;
    public static  $STAT_TELAH_DIGUNAKAN = 1;

    protected $table = 'merchandise_artis_dibeli';
    protected $fillable = [
        'id_artis_merchandise',
        'id_penonton',
        'jum',
        'total_harga',
        'status_dibeli',
        'status_pengiriman',
    ];
    public function artisMerchandise()
    {
        return $this->belongsTo(ArtisMerchandise::class, 'id_artis_merchandise');
    }
    public function penonton()
    {
        return $this->belongsTo(Penonton::class, 'id_penonton');
    }
}
