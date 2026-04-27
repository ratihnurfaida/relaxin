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
            $table->unsignedBigInteger('id_hotel'); //foreign key harus unsignedBigInteger
            $table->string('kode_kamar');
            $table->string('tipe_kamar');
            $table->integer('kapasitas');
            $table->bigInteger('harga_3jam');
            $table->bigInteger('harga_6jam');
            $table->bigInteger('harga_12jam');
            $table->integer('total_kamar');
            $table->string('gambar')->nullable();
            $table->timestamps();

            //definisi relasi
            $table->foreign('id_hotel')
                ->references('id_hotel')
                ->on('hotel')
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
