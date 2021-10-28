<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends CustomController
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (request()->isMethod('POST')){
            return $this->store();
        }
        $user = User::with('pelanggan')->paginate(10);

        return view('admin.user')->with(['data' => $user]);
    }

    public function store()
    {
        $field = \request()->validate(
            [
                'username' => 'required',
                'nama'     => 'required',
                'password' => 'required|confirmed',
            ]
        );
        if (strpos($field['password'], '*') === false) {
            Arr::set($field, 'password', Hash::make($field['password']));
        }

        $pelanggan = \request()->validate(
            [
                'alamat'   => 'required',
                'no_ktp'   => 'required',
                'no_hp'    => 'required',
//                'foto_ktp' => 'required',
            ]
        );

        if (\request('id')) {
            $username = User::where([['username','=',$field['username']],['id','!=',\request('id')]])->first();
            if ($username) {
                return response()->json(
                    [
                        "msg" => "The username has already been taken.",
                    ],
                    '201'
                );
            }
            $user = User::with('pelanggan')->find(\request('id'));
            if (request()->hasFile('foto_ktp')){
                if ($user->pelanggan->foto_ktp){
                        if (file_exists('../public'.$user->pelanggan->foto_ktp)) {
                            unlink('../public'.$user->pelanggan->foto_ktp);
                        }
                }
                $textImg = $this->generateImageName('foto_ktp');
                $string = '/images/ktp/'.$textImg;
                $this->uploadImage('foto_ktp', $textImg, 'ktp');
                Arr::set($pelanggan,'foto_ktp', $string);
            }
            Arr::forget($field,'password');
            if (strpos(request('password'), '*') === false) {
                Arr::set($field,'password',Hash::make(request('password')));
            }
            $user->update($field);
            $user->pelanggan()->update($pelanggan);
        } else {
            Arr::set($field, 'roles', 'pelanggan');
            $user = User::create($field);
            $textImg = $this->generateImageName('foto_ktp');
            $string = '/images/ktp/'.$textImg;
            $this->uploadImage('foto_ktp', $textImg, 'ktp');
            Arr::set($pelanggan,'foto_ktp', $string);
            $user->pelanggan()->create($pelanggan);

        }
    }
}
