<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keyword_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keyword_id')->constrained('keyword')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('user_skill')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_mapping');
    }
};
