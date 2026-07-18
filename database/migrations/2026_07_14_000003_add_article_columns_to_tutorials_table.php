<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tutorials', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('judul');
            $table->string('thumbnail')->nullable()->after('deskripsi');
            $table->longText('konten')->nullable()->after('thumbnail');
            $table->string('penulis')->nullable()->after('konten');
            $table->integer('dilihat')->default(0)->after('penulis');
        });
    }

    public function down(): void
    {
        Schema::table('tutorials', function (Blueprint $table) {
            $table->dropColumn(['slug', 'thumbnail', 'konten', 'penulis', 'dilihat']);
        });
    }
};
