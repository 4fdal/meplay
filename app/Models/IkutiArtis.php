<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkutiArtis extends Model
{
    use HasFactory;
    protected $table = 'artis_konser';
    protected $fillable = [
        'id_artis',
        'id_penonton',
    ];

    public function artis(){
        return $this->belongsTo(Artis::class, 'id_artis') ;
    }
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton') ;
    }
}
