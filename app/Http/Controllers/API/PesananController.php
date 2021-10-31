<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Perkembangan;
use App\Models\PesananRumah;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    //
    public function index(){
        $pesanan = PesananRumah::where('user_id','=',Auth::id())->get();
        return $pesanan;
    }

    public function perkembangan($id){
        $perkembangan = PesananRumah::with('perkembangan')->find($id);
        return $perkembangan;
    }

    public function perkembanganDetail($id, $d){
        $perkembangan = PesananRumah::with(['perkembangan' => function($query) use ($d){
            $query->where('id','=', $d)->with('image')->first();
        }])->find($id);
        return $perkembangan;
    }


}
