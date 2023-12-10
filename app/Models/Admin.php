<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
class Admin extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'admin';
    protected $guarded = [];
    public $timestamps = true;


    public function getAuthIdentifierName() {
        return 'id';
    }
    public function getAuthIdentifier() {
    return $this->getKey(); // Mengembalikan nilai ID pengguna
    }

    public function getAuthPassword() {
    return $this->password; // Mengembalikan kolom password dalam tabel
    }

    public function setRememberToken($value) {
    $this->remember_token = $value; // Kolom token dalam tabel
    }

    public function getRememberToken() {
        return $this->remember_token; // Kolom token dalam tabel
    }

    public function getRememberTokenName() {
        return 'remember_token'; // Nama kolom token dalam tabel
    }




}
