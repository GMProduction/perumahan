<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPerkembangan extends Model
{
    use HasFactory;

    protected $fillable = [
      'perkembangan_id',
      'image',
    ];
}
