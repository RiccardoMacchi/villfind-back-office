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
        Schema::create('rating_villain', function (Blueprint $table) {
            $table->foreignId('villan_id')->constrained('villains')->cascadeOnDelete();
            $table->foreignId('rating_id')->constrained('ratings')->cascadeOnDelete();
            $table->string('full_name');
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_villain');
    }
};
