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
        DB::statement('CREATE OR REPLACE FUNCTION p_user_matricula(p_matricula VARCHAR)
RETURNS TABLE(id BIGINT, name VARCHAR, email VARCHAR) AS $$
BEGIN
    RETURN QUERY
    SELECT users.id, users.name, users.email
    FROM users
    WHERE users.matricula = p_matricula;
END;
$$ LANGUAGE plpgsql');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop function p_user_matricula');
    }
};
