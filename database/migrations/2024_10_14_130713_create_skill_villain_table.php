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

        Schema::create('skill_villain', function (Blueprint $table) {
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->foreignId('villain_id')->constrained('villains')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_villain');
    }
};
