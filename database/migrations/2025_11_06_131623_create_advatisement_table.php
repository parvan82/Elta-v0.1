<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('advatisement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('service_type', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('price', 255)->nullable();
            $table->enum('status', ['open', 'expired'])->default('open')->comment('open = باز | expired = منقضی شده');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('advatisement');
    }

};
