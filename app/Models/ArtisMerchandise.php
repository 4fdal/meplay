<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisMerchandise extends Model
{
    use HasFactory;
    protected $table = 'artis_merchandise';
    protected $fillable = [
        'id_artis',
        'foto',
        'nama',
        'harga',
        'desk',
    ];

    public function artis(){
        return $this->belongsTo(Artis::class, 'id_artis');
    }
}

