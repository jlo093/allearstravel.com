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
        Schema::create('provisional_booking_guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('dob');
            $table->enum('gender', ['m','f','x']);
            $table->foreignId('provisional_booking_id');
            $table->timestamps();

            $table->foreign('provisional_booking_id')->references('id')->on('provisional_bookings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provisional_booking_guests');
    }
};
