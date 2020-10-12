<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonserMerchandise extends Model
{
    use HasFactory;
    protected $table = 'konser_merchandise';
    protected $fillable = [
        'id_konser_eo',
        'foto',
        'nama',
        'harga',
        'desk',
    ];
    public function konserEO() {
        return $this->belongsTo(KonserEO::class, 'id_konser_eo');
    }
    public function merchandiseDibeli() {
        return $this->belongsTo(MerchandiseDibeli::class, 'id_konser_merchandise');
    }

}
