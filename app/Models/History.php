<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jumlah',
        'nim',
        'kelas',
        'email',
        'alat',
        'id_alat',
        'keterangan',
        'keperluan',
        'status',
        'awal_pinjaman',
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