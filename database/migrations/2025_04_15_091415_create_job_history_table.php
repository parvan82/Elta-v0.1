<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('job_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->string('job_title');
            $table->string('job_position');
            $table->string('company_name');
            $table->string('start_date');
            $table->string('end_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_history');
    }
};
