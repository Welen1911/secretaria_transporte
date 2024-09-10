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
        // Criação da função
        DB::statement('CREATE OR REPLACE FUNCTION route_log_function()
            RETURNS trigger AS $$
            BEGIN
                IF (TG_OP = \'INSERT\') THEN
                    INSERT INTO travel_audits(route_id, event_date, details)
                    VALUES (NEW.id, current_timestamp, \'Operação de inserção. A linha de código \' || NEW.id || \' foi inserida\');
                    RETURN NEW;
                ELSIF (TG_OP = \'UPDATE\') THEN
                    INSERT INTO travel_audits(route_id, event_date, details)
                    VALUES (NEW.id, current_timestamp, \'Operação de UPDATE. A linha de código \' || NEW.id || \' teve os valores atualizados de \' || OLD.id || \' para \' || NEW.id || \'.\');
                    RETURN NEW;
                ELSIF (TG_OP = \'DELETE\') THEN
                    INSERT INTO travel_audits(route_id, event_date, details)
                    VALUES (OLD.id, current_timestamp, \'Operação DELETE. A linha de código \' || OLD.id || \' foi excluída\');
                    RETURN OLD;
                END IF;
                RETURN NULL;
            END;
            $$ LANGUAGE plpgsql;
        ');

        // Criação do trigger
        DB::statement('CREATE TRIGGER trigger_log_all_operations
            AFTER INSERT OR UPDATE OR DELETE ON routes
            FOR EACH ROW
            EXECUTE FUNCTION route_log_function();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS trigger_log_all_operations ON routes;');
        DB::statement('DROP FUNCTION IF EXISTS route_log_function();');
    }
};
