<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('ratehawk_id')->nullable();
            $table->string('name');
            $table->enum('category', ['value', 'moderate', 'luxury']);
            $table->smallInteger('stars')->default(2);
            $table->boolean('has_bus')->default(true);
            $table->boolean('has_boat')->default(false);
            $table->boolean('has_skyliner')->default(false);
            $table->string('area_description');
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('meta_policy')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('checkin_time', 8)->nullable();
            $table->string('checkout_time', 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
