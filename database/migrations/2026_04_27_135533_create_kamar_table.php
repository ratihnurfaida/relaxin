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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->unsignedBigInteger('id_penginapan'); //foreign key harus unsignedBigInteger
            $table->string('kode_kamar');
            $table->string('tipe_kamar');
            $table->integer('kapasitas');
            $table->bigInteger('harga_per_kamar');;
            $table->integer('total_kamar');
            $table->string('gambar')->nullable();
            $table->timestamps();

            //definisi relasi
            $table->foreign('id_penginapan')
                ->references('id_penginapan')
                ->on('penginapan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
