<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\FotoPerkembangan;
use App\Models\Perkembangan;
use App\Models\PesananRumah;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PerkembanganController extends CustomController
{
    //
    public function index()
    {
        $pesanan = PesananRumah::with(['user.pelanggan', 'perkembanganAkhir'])->paginate(10);

        return view('admin.perkembangan')->with(['data' => $pesanan]);
    }

    public function detail($id)
    {
        if (\request()->isMethod('POST')){
            return $this->store($id);
        }
        $pesanan = PesananRumah::with(['user', 'perkembangan.image'])->find($id);

        return view('admin.perkembanganDetail')->with(['data' => $pesanan]);

    }

    public function store($id)
    {
        $field = \request()->validate(
            [
                'tanggal'    => 'required',
                'keterangan' => 'required',
                'status'     => 'required',
            ]
        );
        Arr::set($field, 'pesanan_id',$id);
        if (\request('id')) {
            $perkembangan = Perkembangan::find(\request('id'));
            $perkembangan->update($field);
        } else {
            Perkembangan::create($field);
        }
        return 'berhasil';
    }

    public function image($id, $detail){
        if (\request()->isMethod('POST')){
            $perkembangan = Perkembangan::find(\request('id'));
            $file   = $this->generateImageName('file');
            $string = '/images/perkembangan/'.$file;
            $this->uploadImage('file', $file, 'perkembangan');
            $res  = $perkembangan->image()->create(['image' => $string]);
            $data = [
                'id'    => $res['id'],
                'image' => $res['image'],
                'size'  => number_format(floor(filesize(public_path($res['image']))) / 1025, 1, '.', '').' KB',
            ];

            return $data;
        }

        if (\request('action') == 'del'){
            $foto = FotoPerkembangan::find(\request('id'));
            $this->unlinkFile($foto,'image');
            FotoPerkembangan::destroy(\request('id'));
            return response('success');
        }
        $foto = FotoPerkembangan::where('perkembangan_id','=',$detail)->get();
        return $foto;
    }
}
