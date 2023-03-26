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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->unsignedBigInteger('id_video');
            $table->foreign('id_video')->references('id')->on('videos')->onDelete('cascade');
            $table->unsignedBigInteger('id_tag');
            $table->foreign('id_tag')->references('id')->on('tags')->onDelete('cascade');
            $table->string('harga', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
