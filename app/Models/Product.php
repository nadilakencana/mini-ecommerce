<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];
    public $timestamps = true;

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    public function ukuran(){
        return $this->hasMany(VariasiUkuran::class, 'id_product', 'id');
    }
    public function warna(){
        return $this->hasMany(VariasiWarna::class, 'id_product', 'id');
    }
    public function DetailOrder(){
        return $this->hasMany(DetailOrder::class, 'id_product', 'id');
    }
}
