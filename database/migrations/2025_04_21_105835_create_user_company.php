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
            $table->string('company_type');
            $table->string('company_representative_name');
            $table->string('representative_national_code', 10);
            $table->string('representative_phone', 20);
            $table->string('representative_email')->nullable();
            $table->string('company_phone', 20);
            $table->string('national_id', 11); // شناسه ملی شرکت
            $table->string('postal_code', 10)->nullable();
            $table->string('city'); // شهر
            $table->text('address'); // آدرس کامل
            $table->year('established_year');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
