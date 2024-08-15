<?php

namespace App\Services;

use App\Models\AutoMobile;
use Illuminate\Support\Facades\DB;

class AutoMobileService {

    public static function show(string $id) {
        $autoMobile = AutoMobile::find($id);

        if (!$autoMobile) {
            return null;
        }

        return $autoMobile;
    }

    public static function getByTurnCapacity(string $capacity, string $turnId) {

        $autoMobiles = DB::table('auto_mobiles')
        ->whereNotIn('id', function ($query) use ($turnId) {
            $query->select('routes.automobile_id')
                ->from('routes')
                ->join('route_turns', 'routes.id', '=', 'route_turns.route_id')
                ->where('route_turns.turn_id', $turnId);
        })
        ->where('capacity', '>', $capacity)
        ->get();

        return $autoMobiles;
    }

}
