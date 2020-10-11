<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artis;
use App\Models\KonserEO;
use App\Models\Tiket;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){

        $konserEO = KonserEO::latest()->limit(10)->get();
        $konserPopuler = [] ;
        foreach ($konserEO as $key => $value) {
            $tiket = Tiket::where('id_konser_eo', $value->id)->orderBy('harga', 'asc')->first();
            $waktuMulai = explode(' ', $value->waktu_mulai);
            $waktuSelesai = explode(' ', $value->waktu_selesai);
            $konserPopuler[$key] = $value;
            $konserPopuler[$key]['mulai_harga_tiket'] = $tiket->harga;
            $konserPopuler[$key]['tanggal'] = $waktuMulai[0] . ' - ' . $waktuSelesai[0];
            $konserPopuler[$key]['waktu'] = $waktuMulai[1] . ' - ' . $waktuSelesai[1];
        }

        $konserEO = KonserEO::where('waktu_mulai', '<=', date('Y-m-d H:i:s'))->get();
        $konserBulanIni = [];
        foreach ($konserEO as $key => $value) {
            $tiket = Tiket::where('id_konser_eo', $value->id)->orderBy('harga', 'asc')->first();
            $waktuMulai = explode(' ', $value->waktu_mulai);
            $waktuSelesai = explode(' ', $value->waktu_selesai);
            $konserBulanIni[$key] = $value;
            $konserBulanIni[$key]['mulai_harga_tiket'] = $tiket->harga;
            $konserBulanIni[$key]['tanggal'] = $waktuMulai[0] . ' - ' . $waktuSelesai[0];
            $konserBulanIni[$key]['waktu'] = $waktuMulai[1] . ' - ' . $waktuSelesai[1];
        }

        $konserEO = KonserEO::where('waktu_mulai', '>', date('Y-m-d H:i:s'))->get();
        $konserMendatang = [];
        foreach ($konserEO as $key => $value) {
            $tiket = Tiket::where('id_konser_eo', $value->id)->orderBy('harga', 'asc')->first();
            $waktuMulai = explode(' ', $value->waktu_mulai);
            $waktuSelesai = explode(' ', $value->waktu_selesai);
            $konserMendatang[$key] = $value;
            $konserMendatang[$key]['mulai_harga_tiket'] = $tiket->harga;
            $konserMendatang[$key]['tanggal'] = $waktuMulai[0] . ' - ' . $waktuSelesai[0];
            $konserMendatang[$key]['waktu'] = $waktuMulai[1] . ' - ' . $waktuSelesai[1];
        }

        return response([
            'data' => [
                'populer' => $konserPopuler,
                'bulanIni' => $konserBulanIni,
                'mendatang' => $konserMendatang,
            ],
        ]);
    }

    public function pencarian(Request $request){
        $konser = new KonserEO();
        $artis = new Artis();
        if(isset($request->nama)) {
            $konser = $konser->where('judul', 'like', "%{$request->nama}%")->get();
            $artis = $artis->where('nama', 'like', "%{$request->nama}%")->get();
        }

        return response([
            'data' => [
                'konser' => $konser,
                'artis' => $artis,
            ]
        ]);
    }
}
