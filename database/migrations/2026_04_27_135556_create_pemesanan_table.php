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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_kamar');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_malam');
            $table->integer('total_tamu');
            $table->integer('jumlah_kamar');
            $table->bigInteger('total_harga');
            $table->enum('status', ['Pending', 'Confirmed', 'Selesai', 'Cancelled']);
            $table->timestamps();

            //relasi foreig key
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
