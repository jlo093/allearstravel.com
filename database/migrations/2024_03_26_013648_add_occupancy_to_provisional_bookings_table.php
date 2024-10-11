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
        Schema::table('provisional_bookings', function (Blueprint $table) {
            $table->addColumn('integer', 'adults')->default(2);
            $table->addColumn('integer', 'children')->default(0);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->addColumn('integer', 'adults')->default(2);
            $table->addColumn('integer', 'children')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provisional_bookings', function (Blueprint $table) {
            //
        });
    }
};
