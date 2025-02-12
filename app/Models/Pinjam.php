<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'kelas',
        'email',
        'alat',
        'jumlah',
        'tempat',
        'keperluan',
        'image',
        'id_alat',
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