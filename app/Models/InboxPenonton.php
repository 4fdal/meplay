<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboxPenonton extends Model
{
    use HasFactory;
    protected $table = 'inbox_penonton';
    protected $fillable = [
        'id_penonton',
        'judul',
        'desk',
    ];
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton') ;
    }
}
