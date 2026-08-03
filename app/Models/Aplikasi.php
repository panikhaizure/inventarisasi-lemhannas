<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'nama_aplikasi',
    'pic',
    'url',
    'domain',
    'server',
    'bahasa_pemograman',
    'framework',
    'os_server',
    'database_engine',
    'web_server',
    'versi',
    'password_server',
    'status',
    'keterangan',
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