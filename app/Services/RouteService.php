<?php

namespace App\Services;

use App\Models\Route;

class RouteService
{
    public static function index()
    {
        $routes = Route::all();

        return $routes;
    }

    public static function store($data)
    {
        $route = Route::create($data);

        return $route;
    }

    public static function show(string $id)
    {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        return $route;
    }

    public static function update(string $id, $data)
    {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        $route->update($data);

        return $route;
    }

    public static function destroy(string $id)
    {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        $route->delete();

        return $route;
    }

    public static function showByAutomobileId(string $id)
    {
        $routes = Route::where('automobile_id', $id)->get();

        if (!$routes) {
            return null;
        }

        return $routes;
    }

    public static function showByDriverId(string $id)
    {
        $drivers = Route::where('driver_id', $id)->get();

        if (!$drivers) {
            return null;
        }

        return $drivers;
    }
}
