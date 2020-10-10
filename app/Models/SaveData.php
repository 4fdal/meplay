<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveDataText extends Model {


    protected $table = "save_data";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getItem($key){
        $saveDataText = SaveDataText::where('keyText', $key)->first();
        if(!isset($saveDataText)) return null ;
        $data = $saveDataText->valueText ;
        $dataObj = json_decode($data);
        if(isset($dataObj)) $data = $dataObj ;
        return $data ;
    }

    public static function setItem($key, $value){
        if(is_array($value) || is_object($value)) $valueText = json_encode($value);
        $saveDataText = SaveDataText::updateOrCreate([ 
            'key' => $key,
            'value' => $valueText
        ]);
        return $saveDataText ;
    }

    public static function removeItem($key){
        return SaveDataText::where('key', $key)->delete();
    }

}
