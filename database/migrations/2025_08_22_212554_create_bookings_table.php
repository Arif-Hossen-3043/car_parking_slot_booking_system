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
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // links to users table
        $table->string('slot_number');
        $table->string('car_number');
        $table->string('driver_license');
        $table->time('start_time');
        $table->integer('hours');
        $table->boolean('is_paid')->default(false);
        $table->string('payment_method')->nullable();
        $table->timestamps();
    }); //this is updated fr id 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
