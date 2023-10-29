<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
class KategoriController extends Controller
{
    public function indexKategori(){

        $kategori = Kategori::all();

        return view('DasboardAdmin.Kategori.index', compact('kategori'));
    }


    public function createKatgeori(){

        return view('DasboardAdmin.Kategori.create');
    }

    public function postCreate(Request $request){

        $request->validate([
            'nama' => 'required',
            'slug' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->slug = $request->slug;


        if($kategori->save()){
            return redirect()->route('data_kategori')->with('success', 'Data saved successfully');
        }else{
            return redirect()->back()->with('faild', 'Data failed to save, check the input data again');
        }
    }

    public function editData($id){

        $dec = decrypt($id);
        $kategori = Kategori::FindOrfail($dec);

        return view('DasboardAdmin.Kategori.edit', compact('kategori'));


    }

    public function UpdateData(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'slug' => 'required'
        ]);

        $dec = decrypt($id);
        $kategori = Kategori::FindOrfail($dec);
        $kategori->nama = $request->nama;
        $kategori->slug = $request->slug;


        if($kategori->save()){
            return redirect()->route('data_kategori')->with('success', 'Data updated successfully');
        }else{
            return redirect()->back()->with('faild', 'Data failed to update. Check the input data again');
        }
    }

    public function deleteData($id){
        $dec = decrypt($id);
        $kategori = Kategori::findOrFail($dec);
        $kategori->delete();

       if($kategori->delete()){
            return redirect()->route('data_kategori')->with('success', 'Data delete successfully');
        }else{
            return redirect()->back()->with('faild', 'Data failed to delete');
        }
    }
}
