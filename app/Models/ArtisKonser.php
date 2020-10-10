<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisKonser extends Model
{
    use HasFactory;
    protected $table = 'artis_konser';
    protected $fillable = [
        'id_eo',
        'id_konser_eo',
        'id_artis',
    ];

    public function eo(){
        return $this->belongsTo(EO::class, 'id_eo') ;
    }
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
    public function artis(){
        return $this->belongsTo(Artis::class, 'id_artis') ;
    }
}
