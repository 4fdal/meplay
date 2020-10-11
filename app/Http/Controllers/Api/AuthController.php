<?php

namespace App\Http\Controllers\Api;

use App\helper\SendEmail\RequestSendEmail;
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

        $user = User::where('no_hp', $request->no_hp)->first();
        if(!isset($user)) return response([
            'errCode' => -2,
            'err' => ['tidak data nomor yang sesuai']
        ], 404);

        if(!Hash::check($request->password, $user->password)) return response([
            'errCode' => -2,
            'err' => ['password tidak sesui'],
        ]);

        if(!$user->verifikasi_akun) return response([
            'errCode' => -2,
            'err' => ['akun belum terverifikasi'],
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
            'no_hp' => ['required', 'unique:users,no_hp', 'numeric'],
            'email' => ['required', 'unique:users,email', 'email' ],
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
        $verifikasiToken = Str::random(4);
        switch ($request->level) {
            case Level::$NAME_LEVEL_EO:
                $idLevel = Level::$ID_LEVEL_EO;
                $user = $user->create([
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'id_level' => $idLevel,
                    'verifikasi_token' => $verifikasiToken,
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
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'id_level' => $idLevel,
                    'verifikasi_token' => $verifikasiToken,
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
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'id_level' => $idLevel,
                    'verifikasi_token' => $verifikasiToken ,
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

        RequestSendEmail::send('mail.verifikasi_email', $request->email, [
            'nama' => $request->nama,
            'subject' => 'Verifikasi Akun',
            'title' => 'Token Verifikasi',
            'verifikasi_token' => $verifikasiToken,
        ]);

        return response([
            'msg' => ['berhasil register'],
            'data' => $response,
        ]);

    }
    public function sendVerifikasiToken(Request $request){
        $valid = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        if ($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);
        $user = User::where('email', $request->email)->first();
        if (!isset($user)) return response([
            'errCode' => -2,
            'err' => ['tidak data nomor yang sesuai']
        ], 404);
        $verifikasiToken = Str::random(3).$user->id;
        $user->update([
            'verifikasi_token' => $verifikasiToken,
        ]);
        RequestSendEmail::send('mail.verifikasi_email', $request->email, [
            'nama' => 'User',
            'subject' => 'Verifikasi Akun',
            'title' => 'Token Verifikasi',
            'verifikasi_token' => $user->verifikasi_token,
        ]);
        return response([
            'msg' => ['berhasil mengirimkan verifikasi kode']
        ]);
    }
    public function verifikasiAkun(Request $request){
        $valid = Validator::make($request->all(), [
            'verifikasi_token' => ['required'],
            'email' => ['required', 'email'],
        ]);
        if ($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);
        $user = User::where('verifikasi_token', $request->verifikasi_token)->where('email', $request->email)->first();
        if (!isset($user)) return response([
            'errCode' => -2,
            'err' => ['data token tidak sesuai']
        ], 404);
        
        $user->update([
            'verifikasi_token' => '',
            'verifikasi_akun' => 1,
        ]);

        return response([
            'msg' => ['berhasil verifikasi akun']
        ]);
    }
    public function sendRememberToken(Request $request){
        $valid = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        if ($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);
        $user = User::where('email', $request->email)->first();
        if (!isset($user)) return response([
            'errCode' => -2,
            'err' => ['tidak data nomor yang sesuai']
        ], 404);
        $rememberToken = Str::random(10).$user->id;
        $user->update([
            'remember_token' => $rememberToken,
        ]);
        RequestSendEmail::send('mail.remember_password', $request->email, [
            'nama' => 'User',
            'subject' => 'Remember Akun',
            'title' => 'Token Remember',
            'remember_token' => $user->remember_token,
        ]);
        return response([
            'msg' => ['berhasil mengirimkan verifikasi kode']
        ]);
    }
    public function rememberToken(Request $request){
        $valid = Validator::make($request->all(), [
            'remember_token' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);
        if ($valid->fails()) return response([
            'errCode' => -1,
            'err' => $valid->errors()
        ], 422);
        $user = User::where('remember_token', $request->remember_token)->first();
        if (!isset($user)) return response([
            'errCode' => -2,
            'err' => ['data token tidak sesuai']
        ], 404);

        $user->update([
            'remember_token' => '',
            'password' => Hash::make($request->password),
        ]);

        return response([
            'msg' => ['berhasil ubah password akun']
        ]);
    }
}
