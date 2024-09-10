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
        DB::statement('CREATE VIEW v_routes AS
SELECT
    routes.id AS route_id,
    routes.driver_id AS driver,
    routes.automobile_id AS automobile,
    routes.turn_id AS turn,
    routes.status,
    routes.capacity,
    routes.start AS r_start,
    routes.end AS r_end,
    drivers.id AS driver_id,
    drivers.category AS driver_category,
    drivers.status AS driver_status,
    auto_mobiles.id AS automobile_id,
    auto_mobiles.model AS car_model,
    auto_mobiles.year AS car_year,
    auto_mobiles.plate AS car_plate,
    turns.id AS turn_id,
    turns.period AS turn_period,
    turns.start_begin AS turn_start_begin,
    turns.start_return AS turn_start_return
FROM
    routes
INNER JOIN
    drivers ON routes.driver_id = drivers.id
INNER JOIN
    auto_mobiles ON routes.automobile_id = auto_mobiles.id
INNER JOIN
    turns ON routes.turn_id = turns.id
WHERE
    routes.deleted_at IS NULL
    AND drivers.deleted_at IS NULL
    AND auto_mobiles.deleted_at IS NULL
    AND turns.deleted_at IS NULL;
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW v_routes');
    }
};
