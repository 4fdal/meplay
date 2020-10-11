<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\KonserEOController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/send_verifikasi_token', [AuthController::class, 'sendVerifikasiToken']);
        Route::post('/verifikasi_akun', [AuthController::class, 'verifikasiAkun']);
        Route::post('/send_remember_token', [AuthController::class, 'sendRememberToken']);
        Route::post('/remember_akun', [AuthController::class, 'rememberToken']);
    });

    Route::get('/home_page', [HomePageController::class, 'index']);
    Route::post('/pencarian', [HomePageController::class, 'pencarian']);
    Route::get('/konser/{idKonser}', [KonserEOController::class, 'show']);
    Route::post('/konser/add_tiket/{idTiket}', [KonserEOController::class, 'addTiket']);
    Route::post('/konser/add_merc/{idMerc}', [KonserEOController::class, 'addMerc']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'konser'], function () {
            Route::post('/beli_tiket', [KonserEOController::class, 'beliTiket']);
            Route::post('/beli_merc', [KonserEOController::class, 'beliMerc']);

            Route::get('/info_pembayaran/{idkonser}', [KonserEOController::class, 'infoPembayaran']);
            Route::post('/pembayaran', [KonserEOController::class, 'pembayaran']);
        });
    });
});

Route::group(['prefix' => 'document'], function () {
    Route::post('/', [DocumentController::class, 'postDocument'])->name('post.document');
    Route::get('/{keyDocument}', [DocumentController::class, 'getDocument'])->name('get.document');
});

Route::group(['prefix' => 'data'], function () {
    Route::post('/', [DataController::class, 'postData'])->name('post.data');
    Route::get('/{keyData}', [DataController::class, 'getData'])->name('get.data');
});