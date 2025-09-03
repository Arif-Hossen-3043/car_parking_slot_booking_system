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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dateTime('end_time')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled

            // ✅ Add index for faster conflict checks
            $table->index(['slot_number', 'start_time', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['slot_number', 'start_time', 'end_time']);
            $table->dropColumn(['end_time', 'status']);
        });
    }
};
