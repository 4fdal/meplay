<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\DocumentController;

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
});

Route::group(['prefix' => 'document'], function () {
    Route::post('/', [DocumentController::class, 'postDocument'])->name('post.document');
    Route::get('/{keyDocument}', [DocumentController::class, 'getDocument'])->name('get.document');
});

Route::group(['prefix' => 'data'], function () {
    Route::post('/', [DataController::class, 'postData'])->name('post.data');
    Route::get('/{keyData}', [DataController::class, 'getData'])->name('get.data');
});