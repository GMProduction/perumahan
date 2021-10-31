<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesananRumah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

class PesananController extends Controller
{
    //
    public function index()
    {
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        $pesanan = PesananRumah::with('user')->paginate(10);
        $user    = User::where('roles', '=', 'Pelanggan')->get();
        $data    = [
            'data' => $pesanan,
            'user' => $user,
        ];

        return view('admin.pembelian')->with($data);
    }

    public function store()
    {
        $field = \request()->validate(
            [
                'user_id' => 'required',
                'tipe_rumah' => 'required',
                'tanggal_beli' => 'required',
                'deskripsi' => 'required',
                'no_sertifikat' => 'required',
            ]
        );
        if (\request('id')) {
            $pesanan = PesananRumah::find(\request('id'));
            $pesanan->update($field);

        } else {
            $tgl = \date('Ymd', strtotime($field['tanggal_beli']));
            $jam = \date('his', strtotime(now('Asia/Jakarta')));
            $no = 'ID'.$tgl.$jam;
            Arr::set($field,'no_pesanan',$no);
            $pesanan = PesananRumah::create($field);
        }
        return $pesanan;
    }
}
