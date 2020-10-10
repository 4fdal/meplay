<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaveDataText;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller{
    public function getData($key){
        $data = SaveDataText::getItem($key);
        if(!isset($data)) return response([
            'msgCode' => -3,
            'err' => ['data tidak ditemukan']
        ]);
        return response([
            'msgCode' => 1,
            'data' => $data,
        ]);
    }
    public function postData(Request $request){
        $valid = Validator::make($request->all(), [
            'key' => ['required', 'string'],
            'value' => ['required']
        ]);
        if($valid->fails()) return response([
            'msgCode' => -1,
            'err' => $valid->errors()
        ]);
        return response([
            'msgCode' => 1,
            'msg' => ['berhasil meyimpan data'],
        ]);
    }
}
