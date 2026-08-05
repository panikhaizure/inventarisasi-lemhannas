<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama_aplikasi',
    'pic',
    'status',
    'server',
    'uraian_singkat',
    'url_aplikasi',
    'alamat_ip',
    'jenis_akses',
    'platform_aplikasi',
    'platform_database',
    'bahasa_pemrograman',
    'framework',
    'os_server',
    'database_engine',
    'web_server',
    'password_server',
];

    /**
     * 'encrypted' membuat Laravel otomatis meng-enkripsi saat disimpan
     * dan mendekripsi saat dibaca, sesuai rekomendasi SRS 5.4.
     */
    protected function casts(): array
    {
        return [
            'password_server' => 'encrypted',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}