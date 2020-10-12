<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KonserEO;
use App\Models\KonserMerchandise;
use App\Models\MerchandiseDibeli;
use App\Models\Tiket;
use App\Models\TiketDibeli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KonserEOController extends Controller
{
    public function show($idKonser){
        $konserEO = KonserEO::find($idKonser);
        if(!isset($konserEO)) return response([ 
            'errCode' => -2,
            'err' => ['data tidak ditemukan']    
        ], 404) ;

        $wMulai = explode(' ', $konserEO->waktu_mulai) ;  
        $wSelesai = explode(' ', $konserEO->waktu_selesai) ;  

        $waktu = $wMulai[1].' - '.$wSelesai[1] ;
        $tanggal = $wMulai[0].' - '.$wSelesai[0] ;

        $dataKonser = [
            "id" => $konserEO->id,
            "id_eo" => $konserEO->id_eo,
            "jum_tiket" => $konserEO->jum_tiket,
            "foto" => $konserEO->foto,
            "judul" => $konserEO->judul,
            "waktu_mulai" => $konserEO->waktu_mulai,
            "waktu_selesai" => $konserEO->waktu_selesai,
            "desk" => $konserEO->desk,
            "link_live_konser" => $konserEO->link_live_konser,
            "created_at" => $konserEO->created_at,
            "updated_at" => $konserEO->updated_at,
            "waktu" => $waktu,
            "tanggal" => $tanggal,
        ];
        $dataArtis = [] ;
        foreach ($konserEO->artisKonser as $key => $value) {
            $dataArtis[$key] = $value->artis ;
        }
        $dataTiket = $konserEO->tiket ;
        $dataMerchandise = $konserEO->konserMerchandise ;
        
        $response = [
            'konser' => $dataKonser,
            'artis' => $dataArtis,
            'tiket' => $dataTiket,
            'merc' => $dataMerchandise,
        ];

        return response([
            'data' => $response,
        ]) ;
    }

    // harus login
    public function beliTiket(Request $request){
        $valid = Validator::make($request->all(), [
            'jumlah' => ['required', 'numeric'],
            'id_tiket' => ['required', 'numeric']
        ]);
        if($valid->fails()) return response([
            'errMsg' => -1,
            'err' => $valid->errors(),
        ], 422);
        $user = Auth::user();
        $penonton = $user->penonton ;
        $idPenonton = $penonton->id ;
        $idTiket = $request->id_tiket ;

        $tiket = Tiket::find($idTiket);
        if(!isset($tiket)) return response([
            'errMsg' => -2,
            'err' => ['data tiket tidak ditemukan']
        ], 404);

        $dataTiket = [] ;
        $totalHarga = 0 ;
        for($i=0; $i<$request->jumlah; $i++){
            $tiketDibeli = TiketDibeli::create([
                'id_tiket' => $tiket->id,
                'id_penonton' => $idPenonton,
                'id_konser_eo' => $tiket->id_konser_eo,
                'jum_replay' => 0,
                'waktu_dibeli' => date('Y-m-d H:i:s') ,
                'total_harga' => $tiket->harga,
                'status_dibeli' => TiketDibeli::$DIBELI_STAT_TUNGGU_PEMBAYARAN,
                'status_penggunaan' => TiketDibeli::$STAT_BELUM_DIGUNAKAN,
            ]);
            $totalHarga += $tiket->harga ; 
            $dataTiket[$i] = $tiketDibeli ;
        }
        
        return response([
            'data' => [
                'tiket' => $dataTiket,
                'totalHarga' => $totalHarga,
            ],
        ]);
    }
    
    public function beliMerc(Request $request){
        $valid = Validator::make($request->all(), [
            'jumlah' => ['required', 'numeric'],
            'id_merc' => ['required', 'numeric']
        ]);
        if($valid->fails()) return response([
            'errMsg' => -1,
            'err' => $valid->errors(),
        ], 422);

        $user = Auth::user();
        $penonton = $user->penonton;
        $idPenonton = $penonton->id;
        $idMerc = $request->id_merc;

        $merc = KonserMerchandise::find($idMerc);
        if (!isset($merc)) return response([
            'errMsg' => -2,
            'err' => ['data tiket tidak ditemukan']
        ], 404);

        $jumlah = $request->jumlah ;
        $harga = $merc->harga ;

        $mercDibeli = MerchandiseDibeli::create([
            'id_konser_marchandise' => $merc->id,
            'id_penonton' => $penonton->id,
            'jum' => $jumlah,
            'total_harga' => $jumlah * $harga,
            'status_dibeli' => MerchandiseDibeli::$DIBELI_STAT_TUNGGU_PEMBAYARAN,
            'status_pengiriman' => MerchandiseDibeli::$STAT_BELUM_DIKIRIM,
        ]);

        return response([
            'data' => $mercDibeli,
        ]);
    }

    public function addMerc(Request $request, $idMerc){
        $jum = 0;
        if (isset($request->jumlah)) $jum = $request->jumlah;
        $tiket = KonserMerchandise::find($idMerc);
        if (!isset($tiket)) return response([
            'errCode' => -2,
            'err' => ['tiket tidak ditemukan'],
        ], 404);
        $harga = $tiket->harga;
        return response([
            'harga' => $jum * $harga,
        ]);
    }

    public function addTiket(Request $request, $idTiket){
        $jum = 0 ;
        if(isset($request->jumlah)) $jum = $request->jumlah ;
        $tiket = Tiket::find($idTiket) ;
        if(!isset($tiket)) return response([
            'errCode' => -2,
            'err' => ['tiket tidak ditemukan'],
        ], 404);
        $harga = $tiket->harga ;
        return response([
            'harga' => $jum * $harga, 
        ]);
    }

    public function infoPembayaran($idkonser){
        $konserEO = KonserEO::find($idkonser);
        if(!isset($konserEO)) return response([
            'errCode' => -2,
            'err' => ['data tidak ditemukan']
        ], 404);
        $user = Auth::user();
        $penonton = $user->penonton ;
        $alamat = $penonton->alamat ;
        $idPenonton = $penonton->id ;

        $waktu = $konserEO->waktu();
        $detailPembayaran = $konserEO->detailPembelian($idPenonton);
        
        $data = [
            'judul' => $konserEO->judul,
            'waktu' => $waktu->time,
            'tanggal' => $waktu->tanggal,
            'foto' => $konserEO->foto,
            'alamat' => $alamat,
            'detailPembelian' => $detailPembayaran->detailPembelian,
            'jumlah_pembelian' => $detailPembayaran->jumlah,
            'total_harga_pembelian' => $detailPembayaran->totalHarga,
        ];

        return response([
            'data' => $data,
        ]);

    }
    
    public function pembayaran(Request $request){

    }

}