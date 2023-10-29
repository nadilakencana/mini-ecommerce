<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariasiWarna extends Model
{
    use HasFactory;
    protected $table = 'variasi_warnas';
    protected $guarded = [];
    public $timestamps = true;

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
    public function detailOrder(){
        return $this->hasMany(DetailOrder::class,'id_warna', 'id');
    }
}
