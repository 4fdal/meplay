<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseDibeli extends Model
{
    use HasFactory;

    public static  $DIBELI_STAT_TUNGGU_PEMBAYARAN = 1;
    public static  $DIBELI_STAT_SEDANG_VERIFIKASI = 2;
    public static  $DIBELI_STAT_SELESAI = 3;

    public static  $STAT_BELUM_DIKIRIM = 0;
    public static  $STAT_TELAH_DIKIRIM = 1;

    protected $table = 'merchandise_dibeli';
    protected $fillable = [
        'id_konser_marchandise',
        'id_penonton',
        'jum',
        'total_harga',
        'status_dibeli',
        'status_pengiriman',
    ];
    public function konserMerchandise()
    {
        return $this->belongsTo(KonserMerchandise::class, 'id_konser_marchandise');
    }
    public function penonton()
    {
        return $this->belongsTo(Penonton::class, 'id_penonton');
    }
    public static function totalMerc($idPenonton, $idKonserEo){
        $merc = MerchandiseDibeli::where('id_penonton', $idPenonton)->get();
        foreach ($merc as $key => $value) {
            $value->konserMerchandise ;
        }
        $merc = collect($merc->toArray());
        $merc = $merc->where('konser_merchandise.id_konser_eo', $idKonserEo);

        $dataMerc = $merc->map(function($item, $index){
            return (Object) [
                'nama' => $item['konser_merchandise']['nama'],
                'jumlah' => $item['jum'],
                'total_harga' => $item['total_harga'],
            ];
        });

        return $dataMerc ;
    }
}
