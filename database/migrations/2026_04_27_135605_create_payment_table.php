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
        Schema::create('payment', function (Blueprint $table) {
            $table->id('payment');
            $table->unsignedBigInteger('id_booking');
            $table->bigInteger('jumlah_bayar');
            $table->string('metode_payment');
            $table->string('bukti_payment');
            $table->enum('status', ['Pending', 'Confirmed', 'Selesai', 'Cancelled']);
            $table->timestamps();

            //relasi foreign key
            $table->foreign('id_booking')->references('id_booking')->on('booking')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
