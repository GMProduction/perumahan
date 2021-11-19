<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //

    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function login(){
        if (\request()->isMethod('GET')){
            return view('login');
        }
        $credentials = [
            'username' => \request('username'),
            'password' => \request('password'),
        ];
        if ($this->isAuth($credentials)) {
            $redirect = '/login';
            if (Auth::user()->roles === 'admin') {
                return redirect('/');
            }

            return Redirect::back()->withErrors(['failed', 'Maaf anda bukan admin']);
        }

        return Redirect::back()->withErrors(['failed', 'Periksa Kembali Username dan Password Anda']);
    }



    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
