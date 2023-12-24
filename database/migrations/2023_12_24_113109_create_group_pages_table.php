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
        Schema::create('group_pages', function (Blueprint $table) {
            $table->increments('gp_id');
            $table->foreignId('group_id')->nullable();
            $table->foreignId('page_id')->nullable();
            $table->string('access')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_pages');
    }
};
