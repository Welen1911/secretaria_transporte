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
        // Schema::table('auto_mobiles', function (Blueprint $table) {
        //     // Criar índice para a coluna plate
        //     $table->index('plate', 'idx_plate');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('auto_mobiles', function (Blueprint $table) {
        //     // Remover índice
        //     $table->dropIndex('idx_plate');
        // });
    }
};
