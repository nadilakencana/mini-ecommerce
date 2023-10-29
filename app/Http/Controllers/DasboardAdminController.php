<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasboardAdminController extends Controller
{
    public function Dasboard(){
        return view('DasboardAdmin.Dasboard');
    }
}
