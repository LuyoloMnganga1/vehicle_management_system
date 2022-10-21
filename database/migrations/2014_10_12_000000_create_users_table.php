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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('profile')->default('images/no_image.jpg');
            $table->longText('signature')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('id_no');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('communication');
            $table->string('apointment_date');
            $table->string('department');
            $table->string('job_title');
            $table->string('role');
            $table->string('special_leave')->default('No');
            $table->string('old_leave')->default('No');
            $table->string('location');
            $table->string('one_time_pin')->nullable();
            $table->timestamp('one_time_pin_date')->nullable();
            $table->string('user_one_time_pin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
