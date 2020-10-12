<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public static function penontonKonserEO($idPenonton, $idKonserEO){
        return TiketDibeli::where('tiket_dibeli.id_penonton', $idPenonton)->where('tiket_dibeli.id_konser_eo', $idKonserEO) ;
    }
    public static function totalTiket($idPenonton, $idKonserEO){
        $tiket = collect(TiketDibeli::join('tiket', 'tiket.id', '=', 'tiket_dibeli.id_tiket')
            ->select('tiket_dibeli.*', 'tiket.nama', 'tiket.harga', 'tiket.harga_replay')
            ->where('tiket_dibeli.id_penonton', $idPenonton)
            ->where('tiket_dibeli.id_konser_eo', $idKonserEO)
            ->get()->toArray());
        
        $groupTiket = $tiket->groupBy('id_tiket');
        
        $dataTiket = $groupTiket[1]->map(function($item, $index) use ($tiket){
            $collect = $tiket->where('id_tiket', $item['id_tiket']) ;
            $totalHarga = 0 ;
            foreach ($tiket as $key => $value) {
                if($value['id_tiket'] == $item['id_tiket']){
                    $totalHarga += ($value['jum_replay'] * $value['harga_replay']) + $value['harga'] ;
                }
            }
            return (Object) [
                'nama' => $item['nama'], 
                'jumlah' => $collect->count(),
                'total_harga' => $totalHarga ,
            ];
        });

        return $dataTiket ;
    }

    public function totalPembayaran(){
        $tiket = $this->tiket ;
        return ($this->jum_replay * $tiket->harga_replay) + $tiket->harga ;
    }
}
