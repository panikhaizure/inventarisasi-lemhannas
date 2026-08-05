<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aplikasis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('nama_aplikasi');
            $table->string('pic');

            // --- TAMBAHAN FIELD BARU ---
            $table->text('uraian_singkat')->nullable();
            $table->string('url_aplikasi')->nullable();
            $table->string('alamat_ip')->nullable();
            $table->enum('jenis_akses', ['publik', 'internal'])->default('internal');
            $table->string('platform_aplikasi')->nullable();
            $table->string('platform_database')->nullable();
            // ---------------------------

            $table->string('url')->nullable();
            $table->string('domain')->nullable();

            $table->string('server')->nullable();
            $table->string('os_server')->nullable();
            $table->string('web_server')->nullable();

            $table->string('bahasa_pemograman')->nullable();
            $table->string('framework')->nullable();
            $table->string('database_engine')->nullable();

            $table->string('versi')->nullable();

            $table->text('password_server')->nullable();

            $table->enum('status', [
                'aktif',
                'tidak_aktif',
                'dalam_pengembangan'
            ])->default('dalam_pengembangan');

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasis');
    }
};