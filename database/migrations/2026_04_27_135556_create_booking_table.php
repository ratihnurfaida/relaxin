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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kamar');
            $table->unsignedBigInteger('id_hotel');
            $table->date('tgl_checkin');
            $table->date('tgl_checkout');
            $table->integer('total_malam');
            $table->integer('total_tamu')->default(1);
            $table->integer('jumlah_kamar');
            $table->bigInteger('total_harga');
            $table->enum('status', ['Pending', 'Confirmed', 'Selesai', 'Cancelled']);
            $table->timestamps();

            //relasi foreig key
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onDelete('cascade');
            $table->foreign('id_hotel')->references('id_hotel')->on('hotel')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
