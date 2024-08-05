<?php

namespace App\Services;

use App\Models\Route;

class RouteService
{
    public static function index() {
        $routes = Route::all();

        return $routes;
    }

    public static function store($data)
    {
        $route = Route::create($data);

        return $route;
    }

    public function show(string $id) {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        return $route;
    }

    public function update(string $id, $data) {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        $route->update($data);

        return $route;
    }

    public function delete(string $id) {
        $route = Route::find($id);

        if (!$route) {
            return null;
        }

        $route->delete();

        return $route;
    }
}
