<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function profile(){
        $profile = Auth::user();
        $order = Order::where('id_user', $profile->id)->get();
        $kategori = Kategori::all();

        return view('FrontEndUser.Auth.profile', compact('profile', 'order', 'kategori'));
    }

    public function updateProfile(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',

        ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;

        if($file = $request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destination = public_path().'/assets/images/Profile_User/';

            if(!file_exists($destination)){
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $fileName);

            $user->image = $fileName;

        }

        // dd($request->image);
        if($user->save()){
            return redirect()->route('user_profile')->with('success', 'Youre profile  updated successfully');
        }else{
             return redirect()->back()->with('error', 'Product data failed to update, check the input data again');

        }
    }
}
