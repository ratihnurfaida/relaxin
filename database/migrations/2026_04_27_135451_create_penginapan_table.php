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
        Schema::create('penginapan', function (Blueprint $table) {
            $table->id('id_penginapan');
            $table->string('kode_kamar')->unique();
            $table->string('nama');
            $table->string('kota');
            $table->text('alamat');
            $table->text('deskripsi');
            $table->tinyInteger('star_rating');
            $table->string('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penginapan');
    }
};
