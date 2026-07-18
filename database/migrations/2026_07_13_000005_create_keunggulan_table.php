<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keunggulan', function (Blueprint $table) {
            $table->id();
            $table->string('icon_class')->nullable();
            $table->string('gradient_class')->nullable();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keunggulan');
    }
};
