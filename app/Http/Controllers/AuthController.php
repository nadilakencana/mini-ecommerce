<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //auth Admin
    public function login(){
        return view('DasboardAdmin.Auth.login');
    }

    public function regist(Request $request){
        return view('DasboardAdmin.Auth.registrasi');
    }

    public function postlogin(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function pushRegist(Request $request){

        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:admin'],
            'no_hp' => ['required'],
            'password' => ['required'],

        ]);
        // dd($request);
        $admin = Admin::create([

            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),

        ]);

        return redirect()->route('login')->with('Success','Selamat Anda Sudah Terdaftar');
    }

    public function logoutAdmin(Request $request){
        Auth::guard('admins')->logout();//authentication logout

        $request->session()->invalidate(); //request di simpan di session

        $request->session()->regenerateToken();

        return redirect('/login-admin');
    }

    //auth User

    public function LoginUser(){
        return view('FrontEndUser.Auth.login_user');
    }
    public function Registrasi(){
        return view('FrontEndUser.Auth.registrasi_user');
    }

    public function PostLoginUser(Request $request){
         $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function PostRegistUser(Request $request){

        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:users'],
            'no_hp' => ['required'],
            'alamat' => ['required'],
            'password' => ['required'],

        ]);
        // dd($request);
        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => bcrypt($request->password),

        ]);

        return redirect()->route('login-user')->with('Success','Selamat Anda Sudah Terdaftar');
    }

    public function logoutUser(Request $request){
        Auth::guard('web')->logout();//authentication logout

        $request->session()->invalidate(); //request di simpan di session

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
