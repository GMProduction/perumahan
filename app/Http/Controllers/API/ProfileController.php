<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        $user = User::with('pelanggan')->find(Auth::id());
        return $user;
    }

    public function store(){
        $field = \request()->validate(
            [
                'username'   => 'required',
                'password' => 'required|confirmed',
            ]
        );
        Arr::forget($field,'password');
        if (strpos(request('password'), '*') === false) {
            Arr::set($field,'password',Hash::make(request('password')));
        }
        $user = User::with('pelanggan')->find(Auth::id());
        $user->update($field);
        return $user;
    }
}
