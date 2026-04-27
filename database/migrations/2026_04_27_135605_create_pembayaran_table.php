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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('pembayaran');
            $table->unsignedBigInteger('id_pemesanan');
            $table->bigInteger('jumlah_bayar');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran');
            $table->enum('status', ['Pending', 'Confirmed', 'Selesai', 'Cancelled']);
            $table->timestamps();

            //relasi foreign key
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
