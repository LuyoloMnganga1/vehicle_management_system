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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_type');
            $table->string('vehicle_name');
            $table->string('vehicle_model');
            $table->string('year');
            $table->string('vehicle_image');
            $table->string('vehicle_status');
            $table->string('Registration_no');
            $table->string('engine_no');
            $table->string('chassis_no');
            $table->string('fuel_type');
            $table->string('fuel_measurement');
            $table->string('vehicle_usage');
            $table->string('aux_meter');
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
        Schema::dropIfExists('vehicles');
    }
};
