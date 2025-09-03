<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slots', function (Blueprint $table) {
            // Drop old unique index on slot_number
            $table->dropUnique(['slot_number']);

            // Add composite unique index (slot_number + vehicle_type)
            $table->unique(['slot_number', 'vehicle_type']);
        });
    }

    public function down(): void
    {
        Schema::table('slots', function (Blueprint $table) {
            // Rollback: drop composite and restore old unique
            $table->dropUnique(['slot_number', 'vehicle_type']);
            $table->unique('slot_number');
        });
    }
};
