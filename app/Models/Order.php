<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function details(){
        return $this->hasMany(DetailOrder::class, 'id_order', 'id');
    }
}
