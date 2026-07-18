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
        Schema::create('paket_internets', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['home', 'voucher']);
            $table->string('nama');
            $table->string('sub_judul')->nullable();
            $table->integer('harga');
            $table->string('periode');
            $table->string('highlight_text')->nullable();
            $table->string('sub_highlight')->nullable();
            $table->json('fitur')->nullable();
            $table->json('keuntungan_tambahan')->nullable();
            $table->string('wa_number')->nullable();
            $table->text('wa_message')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_rekomendasi')->default(false);
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
        Schema::dropIfExists('paket_internets');
    }
};
