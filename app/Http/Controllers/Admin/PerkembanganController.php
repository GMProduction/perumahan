<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesananRumah;
use Illuminate\Http\Request;

class PerkembanganController extends Controller
{
    //
    public function index(){
        $pesanan = PesananRumah::with(['user.pelanggan','perkembanganAkhir'])->paginate(10);
        return view('admin.perkembangan')->with(['data' => $pesanan]);
    }

    public function detail($id){
        $pesanan = PesananRumah::with(['user','perkembangan.image'])->find($id);
        return view('admin.perkembanganDetail')->with(['data' => $pesanan]);

    }
}
