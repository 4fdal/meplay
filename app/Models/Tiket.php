<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $table = 'tiket';
    protected $fillable = [
        'id_konser_eo',
        'nama',
        'level',
        'harga',
        'status_replay',
        'exp_replay',
        'desk',
    ];
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
}
