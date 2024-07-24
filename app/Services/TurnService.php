<?php

namespace App\Services;

use App\Models\Turn;

class TurnService {

    public static function show(string $id) {
        $turn = Turn::find($id);

        if (!$turn) {
            return null;
        }

        return $turn;
    }

}
