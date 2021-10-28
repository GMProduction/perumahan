<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananRumah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe_rumah',
        'tanggal_beli',
        'deskripsi',
        'no_sertifikat',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perkembangan(){
        return $this->hasMany(Perkembangan::class,'pesanan_id');
    }

}
