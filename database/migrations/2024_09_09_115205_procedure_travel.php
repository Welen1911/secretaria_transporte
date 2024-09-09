<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE OR REPLACE PROCEDURE register_travel(
    p_route_id INTEGER,
    p_status INTEGER
)
LANGUAGE plpgsql
AS $$
BEGIN
    -- Inserindo a viagem
    INSERT INTO travel (route_id, status) VALUES (p_route_id, p_status);

    COMMIT;
END;
$$');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop procedure register_travel');
    }
};
