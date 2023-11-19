<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $table = 'detail_orders';
    protected $guarded = [];
    public $timestamps = true;

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function variasiUkuran(){
        return $this->belongsTo(VariasiUkuran::class, 'id_ukuran', 'id');
    }
    public function variasiWarna(){
        return $this->belongsTo(VariasiWarna::class, 'id_warna', 'id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
