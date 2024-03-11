<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['hotel', 'tickets']);
            $table->float('price_net');
            $table->float('price_gross');
            $table->string('supplier_reference')->nullable();
            $table->string('external_reference')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('has_free_cancellation')->default(false);
            $table->date('free_cancellation_deadline')->nullable();
            $table->date('payment_deadline');
            $table->foreignId('hotel_id')->nullable();
            $table->foreignId('order_id');
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
