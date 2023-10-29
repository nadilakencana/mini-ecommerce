<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\VariasiUkuran;
use App\Models\VariasiWarna;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('DasboardAdmin.Product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('DasboardAdmin.Product.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,sgv|max:50000',
            'id_kategori' => 'required',
		]);

        $product = new Product();
        $product ->nama = $request->nama;
        $product ->slug = $request->slug;
        $product ->harga = $request->harga;
        $product ->deskripsi = $request->deskripsi;
        $product ->id_kategori = $request->id_kategori ;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destination = public_path().'/assets/images/product/';

            if(!file_exists($destination)){
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName);
            $product->image = $fileName;

        }

        if($product->save()){
            if($request->has('color')){
                $var_warna = $request->color;

                foreach($var_warna as $color){
                    $var_wr = new VariasiWarna();
                    $var_wr->warna = $color['warna'];
                    $var_wr->id_product = $product->id;
                    $var_wr->save();
                }

            }
            if($request->has('size')){
                $var_ukuran = $request->size;

                foreach($var_ukuran as $size){
                    $var_uk = new VariasiUkuran();
                    $var_uk->ukuran = $size['ukuran'];
                    $var_uk->id_product = $product->id;
                    $var_uk->save();
                }

            }

            return redirect()->route('product.index')->with('success', 'Product saved successfully');
        }else{
             return redirect()->back()->with('error', 'Product data failed to save, check the input data again');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dec = decrypt($id);
        $product = Product::findOrFail($dec);
        $variasiWarna = VariasiWarna::where('id_product', $product->id)->get();
        $variasiUkuran = VariasiUkuran::where('id_product', $product->id)->get();
        $kategori = Kategori::all();

        return view('DasboardAdmin.Product.edit', compact('product', 'variasiWarna','variasiUkuran', 'kategori'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'id_kategori' => 'required',
		]);
        $dec = decrypt($id);
        $product = Product::findOrFail($dec);
        $product ->nama = $request->nama;
        $product ->slug = $request->slug;
        $product ->harga = $request->harga;
        $product ->deskripsi = $request->deskripsi;
        $product ->id_kategori = $request->id_kategori;

        if($file = $request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destination = public_path().'/assets/images/product/';

            if(!file_exists($destination)){
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName);

            $product->image = $fileName;

        }

        if($product->save()){
            if($request->has('color')){
                $var_warna = $request->color;

                foreach($var_warna as $color){
                    if(array_key_exists('id', $color)){
                        $var_wr = VariasiWarna::where('id', $color['id'])->first();
                        $var_wr->warna = $color['warna'];
                        $var_wr->id_product = $product->id;
                        $var_wr->save();
                    }else{
                        $var_wr = new VariasiWarna();
                        $var_wr->warna = $color['warna'];
                        $var_wr->id_product = $product->id;
                        $var_wr->save();
                    }

                }

            }
            if($request->has('size')){
                $var_ukuran = $request->size;

                foreach($var_ukuran as $size){
                    if(array_key_exists('id', $size)){
                        $var_uk = VariasiUkuran::where('id', $size['id'])->first();
                        $var_uk->ukuran = $size['ukuran'];
                        $var_uk->id_product = $product->id;
                        $var_uk->save();
                    }else{
                        $var_uk = new VariasiUkuran();
                        $var_uk->ukuran = $size['ukuran'];
                        $var_uk->id_product = $product->id;
                        $var_uk->save();
                    }

                }

            }

            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        }else{
             return redirect()->back()->with('error', 'Product data failed to update, check the input data again');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dec = decrypt($id);
        $product = Product::findOrFail($dec);

        $product->delete();

        return redirect()->back()->with('success', 'Product has been successfully deleted ');


    }
}
