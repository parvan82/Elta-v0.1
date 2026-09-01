<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_type_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_type_id')->constrained('services_tags')->onDelete('cascade');
            $table->foreignId('ads_id')->constrained('advatisement')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_type_map');
    }
};
