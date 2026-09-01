<?php
// database/migrations/xxxx_xx_xx_create_companies_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_phone', 20)->nullable();
            $table->string('national_id', 11)->nullable(); // شناسه ملی شرکت
            $table->string('city')->nullable(); // شهر
            $table->string('established_year', 4)->nullable();
            $table->string('company_size')->nullable();
            $table->text('company_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
