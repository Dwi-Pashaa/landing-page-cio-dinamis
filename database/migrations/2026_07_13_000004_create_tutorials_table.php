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
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('icon_class')->nullable();
            $table->string('gradient_class')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('video_path')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};
