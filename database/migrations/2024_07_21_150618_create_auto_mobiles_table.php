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
        Schema::create('auto_mobiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()
                ->constrained('companies', 'id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('year');
            $table->string('plate');
            $table->string('model');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_mobiles');
    }
};
