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
        Schema::create('ibprs', function (Blueprint $table) {
            $table->increments('ibpr_id');
            $table->string('ibpr_nama')->nullable();
            $table->string('ibpr_nomor')->nullable();
            $table->foreignId('departemen_id')->nullable();
            $table->string('ibpr_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibprs');
    }
};
