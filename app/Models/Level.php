<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public static $NAME_LEVEL_EO = 'eo' ;
    public static $NAME_LEVEL_ARTIS = 'artis' ;
    public static $NAME_LEVEL_PENONTON = 'penonton' ;
    public static $ID_LEVEL_EO = 1 ;
    public static $ID_LEVEL_ARTIS = 2 ;
    public static $ID_LEVEL_PENONTON = 3 ;

    protected $table = 'level';
    protected $fillable = [
        'nama' , 'desk'
    ];
}
