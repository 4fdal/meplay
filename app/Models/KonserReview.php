<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonserReview extends Model
{
    use HasFactory;
    protected $table = 'konser_review';
    protected $fillable = [
        'id_konser_eo',
        'id_penonton',
        'rating',
        'komentar',
    ];
    public function konserEO(){
        return $this->belongsTo(KonserEO::class, 'id_konser_eo');
    }
    public function penonton(){
        return $this->belongsTo(Penonton::class, 'id_penonton');
    }
}
