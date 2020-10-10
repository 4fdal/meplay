<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class SaveDataDocument extends Model {

    protected $table = "save_data_document";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'original_name',
        'mime_type',
        'value',
    ];

    public static function setItem($key, $fileRequest){
        $originalName = $fileRequest->getClientOriginalName();
        $mimeType = $fileRequest->getClientMimeType();
        $valueDocument = file_get_contents($fileRequest);
        return SaveDataDocument::updateOrCreate([
            'key' => $key,
            'original_name' => $originalName,
            'mime_type' => $mimeType,
            'value' => $valueDocument,
        ]);
    }
    
    public static function getItem($key){
        return SaveDataDocument::where('key', $key)->first();
    }

    public static function removeItem($key){
        return SaveDataDocument::where('key', $key)->delete();
    }

    public static function getDocument($key){
        return url('/api/v1/document', $key) ;
    }

}
