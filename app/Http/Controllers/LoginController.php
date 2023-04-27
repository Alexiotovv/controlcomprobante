<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name','password');
        $status=DB::table('users')
        // ->select('users.status')
        // ->where('users.status','=',1)
        ->where('users.name','=',request('name'))
        ->latest()->first();

        if ($status) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }

            return redirect('/login');
        }else{
            return redirect('/login');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
    
}
