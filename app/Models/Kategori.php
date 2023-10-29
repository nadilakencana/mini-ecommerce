<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $guarded = [];
    public $timestamps = true;

    public function product(){
        return $this->hasMany(Product::class, 'id_kategori', 'id');
    }
}
