<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_personal_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('residence_city')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('military_status')->nullable();
            $table->string('personal_id')->nullable();
            $table->string('email')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // ارتباط با جدول کاربران
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_personal_information');
    }
};
