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
        Schema::create('hotel', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->string('kode_kamar')->nullable();
            $table->string('nama');
            $table->string('kota');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->nullable;
            $table->text('fasilitas')->nullable();
            $table->tinyInteger('star_rating');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
