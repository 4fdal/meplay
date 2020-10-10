<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplayKonserEO extends Model
{
    use HasFactory;
    protected $table = 'replay_konser_eo';
    protected $fillable = [
        'id_konser_eo',
        'link_replay_konser',
    ];
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo') ;
    }
}
