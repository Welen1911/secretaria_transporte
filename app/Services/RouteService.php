<?php

namespace App\Services;

use App\Models\Route;

class RouteService
{

    public static function store($data)
    {
        $route = Route::create($data);

        return $route;
    }
}
