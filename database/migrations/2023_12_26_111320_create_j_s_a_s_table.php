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
        Schema::create('jsas', function (Blueprint $table) {
            $table->increments('jsa_id');
            $table->string('jsa_nama')->nullable();
            $table->string('jsa_nomor')->nullable();
            $table->foreignId('departemen_id')->nullable();
            $table->string('jsa_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jsas');
    }
};
