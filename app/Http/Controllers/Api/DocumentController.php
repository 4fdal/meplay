<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SaveDataDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller{
    public function getDocument($keyDocument){
        $document = SaveDataDocument::getItem($keyDocument);
        if(!isset($document)) return response([
            'msgCode' => -3,
            'err' => ['Data yang dimaksut tidak tersedia'], 
        ], 404);
        return response($document->valueDocument)->header('Content-Type', $document->mimeType);
    }
    public function postDocument(Request $request){
        $valid = Validator::make($request->all(), [
            'nama' => ['required'],
            'document' => ['required', 'max:2048']
        ]);
        if($valid->fails()) return response([ 'msgCode' => -1, 'err' => $valid->errors()]);

        SaveDataDocument::setItem($request->nama, $request->file('document'));

        return response([
            'msgCode' => 1,
            'msg' => ['berhasil menyimpan data']
        ]);
    }
}
