<?php

namespace App\Services;

use App\Models\Driver;

class DriverService {

    public static function show(string $id) {
        $driver = Driver::find($id);

        if (!$driver) {
            return null;
        }

        return $driver;
    }

    public static function getByCategoryCNH(string $capacity) {

        $category = $capacity >= 8 ? 'D' : 'B';

        $driver = Driver::where('category', $category)->first();

        if (!$driver) {
            return null;
        }

        return $driver;
    }

}
