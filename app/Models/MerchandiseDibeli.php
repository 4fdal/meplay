<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseDibeli extends Model
{
    use HasFactory;
    protected $table = 'merchandise_dibeli';
    protected $fillable = [
        'id_konser_marchandise',
        'id_penonton',
        'jum',
        'total_harga',
        'status_dibeli',
        'status_pengiriman',
    ];
    public function konserMerchandise()
    {
        return $this->belongsTo(KonserMerchandise::class, 'id_konser_marchandise');
    }
    public function penonton()
    {
        return $this->belongsTo(Penonton::class, 'id_penonton');
    }
}
