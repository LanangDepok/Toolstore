<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'nama_alat',
        'jumlah',
        'tempat',
        'kategori',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y, H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y, H:i:s');
    }

}