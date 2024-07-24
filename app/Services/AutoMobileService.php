<?php

namespace App\Services;

use App\Models\AutoMobile;

class AutoMobileService {

    public static function show(string $id) {
        $autoMobile = AutoMobile::find($id);

        if (!$autoMobile) {
            return null;
        }

        return $autoMobile;
    }

    public static function getByCapacity(string $capacity) {
        $autoMobile = AutoMobile::where('capacity', '>', $capacity)->first();

        if (!$autoMobile) {
            return null;
        }

        return $autoMobile;
    }

}
