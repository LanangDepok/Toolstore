<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class datapinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'kelas',
        'email',
        'alat',
        'id_alat',
        'jumlah',
        'image',
        'keterangan',
        'keperluan',
        'status',
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