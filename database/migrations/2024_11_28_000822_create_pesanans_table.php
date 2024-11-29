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
            Schema::create('pesanans', function (Blueprint $table) {
                $table->id('id_pesanan');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('id_paket');
                $table->date('tgl_pesanan');
                $table->text('detail');
                $table->string('foto')->nullable();
                $table->enum('status', ['Proses', 'Selesai'])->default('Proses');
                $table->timestamps();
            });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
