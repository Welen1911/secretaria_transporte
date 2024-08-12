<?php

namespace App\Services;

use App\Models\Driver;
use Illuminate\Support\Facades\DB;

class DriverService
{

    public static function show(string $id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return null;
        }

        return $driver;
    }

    public static function getByTurnAndCategoryCNH(string $capacity, string $turnId)
    {

        $category = $capacity >= 8 ? 'D' : 'B';

        $drivers = DB::table('drivers')
            ->whereNotIn('id', function ($query) use ($turnId) {
                $query->select('routes.driver_id')
                    ->from('routes')
                    ->join('route_turns', 'routes.id', '=', 'route_turns.route_id')
                    ->where('route_turns.turn_id', $turnId);
            })
            ->where('category', $category)
            ->get();

        return $drivers;
    }
}
