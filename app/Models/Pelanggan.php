<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'no_ktp',
        'foto_ktp',
        'no_hp',
    ];
}
