<?php

namespace App\Http\Controllers\Api;

use App\helper\SendEmail\RequestSendMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artis;
use App\Models\EO;
use App\Models\Level;
use App\Models\Penonton;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $valid = Validator::make($request->all(), [
            'no_hp' => ['required', 'numeric'],
            'password' => ['required', 'min:6']
        ]);
        if($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);

        $user = User::where('no_hp', $request->no_hp);
        if(isset($user)) return response([
            'errCode' => -2,
            'err' => ['tidak data nomor yang sesuai']
        ], 404);

        if(!Hash::check($request->password, $user->password)) return response([
            'errCode' => -2,
            'err' => ['password tidak sesui'],
        ]);

        $apiToken = $user->api_token ;
        if(!isset($apiToken)){ 
            $apiToken = Str::random(150) . $user->id ;
            $user->update([ 'api_token' => $apiToken ]) ;
        }

        return response([
            'msg' => ['berhasil login'],
            'data' => $user,
            'api_token' => $apiToken 
        ]);
    }
    public function register(Request $request){
        $valid = Validator::make($request->all(), [
            'no_hp' => ['required', 'numeric', 'unique:users'],
            'email' => ['required','email', 'unique:users' ],
            'password' => ['required', 'min:6', 'confirmed'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'level' => ['required'],
        ]);
        $valid->after(function($valid) use ($request) {
            if(!in_array($request->level, [Level::$NAME_LEVEL_EO, Level::$NAME_LEVEL_ARTIS, Level::$NAME_LEVEL_PENONTON])) {
                return $valid->errors()->add('level', 'rules level [eo|artis|penonton]') ;
            }
        });
        if ($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);

        $user = new User();
        switch ($request->level) {
            case Level::$NAME_LEVEL_EO:
                $idLevel = Level::$ID_LEVEL_EO;
                $user = $user->create([
                    'no_hp' => $request->email,
                    'email' => $request->no_hp,
                    'id_level' => $idLevel,
                    'verifikasi_token' => Str::random(10) ,
                    'password' => Hash::make($request->password),
                ]);
                $eo = EO::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                ]);
                break;
            case Level::$NAME_LEVEL_ARTIS:
                $idLevel = Level::$ID_LEVEL_ARTIS;
                $user = $user->create([
                    'no_hp' => $request->email,
                    'email' => $request->no_hp,
                    'id_level' => $idLevel,
                    'verifikasi_token' => Str::random(10) ,
                    'password' => Hash::make($request->password),
                ]);
                $artis = Artis::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                ]);
                break;
            default:
                $idLevel = Level::$ID_LEVEL_PENONTON;
                $user = $user->create([
                    'no_hp' => $request->email,
                    'email' => $request->no_hp,
                    'id_level' => $idLevel,
                    'verifikasi_token' => Str::random(10) ,
                    'password' => Hash::make($request->password),
                ]);
                $penonton = Penonton::create([
                    'id_user' => $user->id,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                ]);
                break;
        };
        
        $response = $user ;
        $response->nama = $request->nama ;
        $response->alamat = $request->alamat ;

        RequestSendMail::send('mail.verifikasi_email', $request->email, [
            'verifikasi_token' => $user->verifikasi_token,
        ]);

        return response([
            'msg' => ['berhasil register'],
            'data' => $response,
        ]);

    }
    public function sendVerifikasiToken(){

    }
    public function verifikasiAkun(){

    }
    public function sendRememberToken(){

    }
    public function rememberToken(){

    }
}
