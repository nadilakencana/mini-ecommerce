<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Product;
use App\Models\VariasiUkuran;
use App\Models\VariasiWarna;

class HomeController extends Controller
{
    public function home(){
        $kategori = Kategori::all();
        $product = Product::take(3)->get();
        return view('FrontEndUser.HomeCustomer.index_home', compact('kategori', 'product'));
    }

    public function allProduct(){
        $kategori = Kategori::all();
        $product = Product::latest()->filter(request(['search']))->paginate(3);
        return view('FrontEndUser.HomeCustomer.product_all', compact('kategori', 'product'));
    }

    public function categoryProduct($slug){
        $kategori = Kategori::all();
        $kat = Kategori::where('slug', $slug)->first();
        $pro_Cat = Product::where('id_kategori', $kat->id)->get();
        return view('FrontEndUser.HomeCustomer.Category_pro', compact('kategori', 'pro_Cat', 'kat'));

    }

    public function DetailPro($slug){

         $kategori = Kategori::all();
         $pro_detail = Product::where('slug', $slug)->first();
         $warna = VariasiWarna::where('id_product', $pro_detail->id)->get();
         $ukuran = VariasiUkuran::where('id_product', $pro_detail->id)->get();
        $product = Product::take(3)->get();
         return view('FrontEndUser.HomeCustomer.Detail_pro', compact('kategori', 'pro_detail', 'warna','ukuran', 'product'));
    }
}
