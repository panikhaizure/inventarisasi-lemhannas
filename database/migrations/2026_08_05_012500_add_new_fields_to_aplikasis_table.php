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
        Schema::table('aplikasis', function (Blueprint $table) {
            if (!Schema::hasColumn('aplikasis', 'url_aplikasi')) {
                $table->string('url_aplikasi')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'uraian_singkat')) {
                $table->text('uraian_singkat')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'alamat_ip')) {
                $table->string('alamat_ip')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'jenis_akses')) {
                $table->string('jenis_akses')->default('internal');
            }
            if (!Schema::hasColumn('aplikasis', 'platform_aplikasi')) {
                $table->string('platform_aplikasi')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'platform_database')) {
                $table->string('platform_database')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'bahasa_pemrograman')) {
                $table->string('bahasa_pemrograman')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'framework')) {
                $table->string('framework')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'os_server')) {
                $table->string('os_server')->nullable();
            }
            if (!Schema::hasColumn('aplikasis', 'database_engine')) {
                $table->string('database_engine')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aplikasis', function (Blueprint $table) {
            $columnsToDrop = [];
            
            $fields = [
                'url_aplikasi', 'uraian_singkat', 'alamat_ip', 
                'jenis_akses', 'platform_aplikasi', 'platform_database', 
                'bahasa_pemrograman', 'framework', 'os_server', 'database_engine'
            ];

            foreach ($fields as $field) {
                if (Schema::hasColumn('aplikasis', $field)) {
                    $columnsToDrop[] = $field;
                }
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};