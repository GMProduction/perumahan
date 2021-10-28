<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function login(){
        $field =\request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username','=',$field['username'])->first();
        if (! $user || ! Hash::check($field['password'],$user->password) || $user->roles != 'pelanggan'){
            return response()->json(
                [
                    'msg'    => 'Login gagal',
                ], 401
            );
        }else{
            $user->tokens()->delete();
            $token = $user->createToken('pelanggan')->plainTextToken;
            $user->update(
                [
                    'token' => $token,
                ]
            );

            return response()->json(
                [
                    'status' => 200,
                    'data'    => [
                        'token' => $token,
                    ],
                ]
            );
        }
    }
}
