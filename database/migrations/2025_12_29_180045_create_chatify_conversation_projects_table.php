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
        if (!Schema::hasTable('chatify_conversation_projects')) {
            Schema::create('chatify_conversation_projects', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id_1'); // ID کوچکتر
                $table->unsignedBigInteger('user_id_2'); // ID بزرگتر
                $table->unsignedBigInteger('project_id');
                $table->timestamps();
                
                // ایجاد index منحصر به فرد برای هر conversation
                $table->unique(['user_id_1', 'user_id_2'], 'unique_conversation');
                $table->foreign('project_id')->references('id')->on('new_projects')->onDelete('cascade');
                $table->index(['user_id_1', 'user_id_2']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatify_conversation_projects');
    }
};
