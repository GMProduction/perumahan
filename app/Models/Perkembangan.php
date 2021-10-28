<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'tanggal',
        'keterangan',
        'status',
    ];


    public function image(){
        return $this->hasMany(FotoPerkembangan::class,'perkembangan_id');
    }
}
