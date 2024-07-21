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
        Schema::create('passenger_travel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('passengers', 'id')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('travel_id')->constrained('travel', 'id')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passenger_travel');
    }
};
