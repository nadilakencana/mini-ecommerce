<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariasiUkuran extends Model
{
    use HasFactory;
    protected $table = 'variasi_ukurans';
    protected $guarded = [];
    public $timestamps = true;

    public function produk(){
        return $this->belongsTo(Product::class, 'id_product','id');

    }

    public function detailOrder(){
        return $this->hasMany(DetailOrder::class, 'id_ukuran', 'id');
    }
}
