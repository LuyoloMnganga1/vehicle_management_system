<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_books', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->string('full_name');
            $table->date('trip_start_date');
            $table->date('trip_end_date');
            $table->string('start_odometer');
            $table->string('kilometers');
            $table->string('destination_start');
            $table->string('destination_end');
            $table->string('trip_datails');
            $table->string('petrol');
            $table->string('oil');
            $table->string('start_comment');
            $table->date('return_date_out');
            $table->date('return_date_in');
            $table->string('return_odometer');
            $table->string('return_kilometers');
            $table->string('return_destination_start');
            $table->string('return_destination_end');
            $table->string('return_petrol');
            $table->string('return_oil');
            $table->string('return_comment');
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
        Schema::dropIfExists('log_books');
    }
};
