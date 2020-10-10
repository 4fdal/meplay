<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NontonKonser extends Model
{
    use HasFactory;
    protected $table = 'nonton_konser';
    protected $fillable = [
        'id_penonton',
        'id_tiket_dibeli',
        'id_konser_eo',
    ];
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton') ;
    }
    public function tiketDibeli(){
        return $this->belongsTo(TiketDibeli::class, 'id_tiket_dibeli') ;
    }
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
}
