<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payment', 'alasan_penolakan')) {
            Schema::table('payment', function (Blueprint $table) {
                $table->text('alasan_penolakan')->nullable()->after('bukti_payment');
            });
        }

        // Samakan data lama ke lowercase, lalu tambahkan status 'ditolak' ke enum
        DB::statement("UPDATE payment SET status = LOWER(status)");
        DB::statement("ALTER TABLE payment MODIFY COLUMN status ENUM('pending','ditolak','confirmed','selesai','cancelled') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE payment MODIFY COLUMN status ENUM('Pending','Confirmed','Selesai','Cancelled') NOT NULL DEFAULT 'Pending'");

        Schema::table('payment', function (Blueprint $table) {
            if (Schema::hasColumn('payment', 'alasan_penolakan')) {
                $table->dropColumn('alasan_penolakan');
            }
        });
    }
};