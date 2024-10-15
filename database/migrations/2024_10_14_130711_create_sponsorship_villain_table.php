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
        Schema::create('sponsorship_villain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('villain_id')->nullable()->constrained('villains')->onCascade('set null');
            $table->foreignId('sponsorship_id')->nullable()->constrained('sponsorships')->onCascade('set null');
            $table->decimal('purchase_price');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship_villain');
    }
};
