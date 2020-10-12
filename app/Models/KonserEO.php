<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

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

    public function tiket(){
        return $this->hasMany(Tiket::class, 'id_konser_eo') ;
    }

    public function artisKonser(){
        return $this->hasMany(ArtisKonser::class, 'id_konser_eo') ;
    }

    public function konserMerchandise(){
        return $this->hasMany(KonserMerchandise::class, 'id_konser_eo');
    }

    public function detailPembelian($idPenonton){
        $beliTiket = TiketDibeli::totalTiket($idPenonton, $this->id);
        $beliMerc = MerchandiseDibeli::totalMerc($idPenonton, $this->id);

        $detailPembelian = [];
        $totalHarga = 0;
        $count = 0 ;
        foreach ($beliTiket as $key => $value) {
            $detailPembelian[$count++] = $value ;
            $totalHarga += $value->total_harga ;
        }
        foreach ($beliMerc as $key => $value) {
            $detailPembelian[$count++] = $value;
            $totalHarga += $value->total_harga ;
        }
        return (Object) [
            'jumlah' => $count,
            'totalHarga' => $totalHarga,
            'detailPembelian' => $detailPembelian,
        ];
    }
    
    public function waktu(){
        $wMulai = explode(' ', $this->waktu_mulai);
        $wSelesai = explode(' ', $this->waktu_selesai);

        $this->time = $wMulai[1] . ' - ' . $wSelesai[1];
        $this->tanggal = $wMulai[0] . ' - ' . $wSelesai[0];

        return $this ;
    }

}
