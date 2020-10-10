<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    
});


Route::group(['prefix' => 'document'], function () {
    Route::post('/', 'DocumentController@postDocument')->name('post.document');
    Route::get('/{keyDocument}', 'DocumentController@getDocument')->name('get.document');
});

Route::group(['prefix' => 'data'], function () {
    Route::post('/', 'DataController@postData')->name('post.data');
    Route::get('/{keyData}', 'DataController@getData')->name('get.data');
});

Route::post('/data', [
    'uses' => 'DataController@postData',
    'as' => 'post.data'
]);

Route::get('/data/{keyData}', [
    'uses' => 'DataController@getData',
    'as' => 'get.data'
]);