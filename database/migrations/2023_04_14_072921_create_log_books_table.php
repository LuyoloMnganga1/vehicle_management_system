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
            $table->string('trip_details');
            $table->string('petrol')->nullable();
            $table->string('oil')->nullable();
            $table->string('start_comment')->nullable();
            $table->date('return_date_out')->nullable();
            $table->date('return_date_in')->nullable();
            $table->string('return_odometer')->nullable();
            $table->string('return_kilometers')->nullable();
            $table->string('return_destination_start')->nullable();
            $table->string('return_destination_end')->nullable();
            $table->string('return_petrol')->nullable();
            $table->string('return_oil')->nullable();
            $table->string('return_comment')->nullable();
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
