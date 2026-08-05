<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // <-- Tambahkan baris ini
        'nama_aplikasi',
        'pic',
        'status',
        'uraian_singkat',
        'url',
        'alamat_ip',
        'jenis_akses',
        'platform_aplikasi',
        'platform_database',
        'bahasa_pemograman',
        'framework',
        'os_server',
        'database_engine',
        'server',
        'web_server',
        'password_server',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}