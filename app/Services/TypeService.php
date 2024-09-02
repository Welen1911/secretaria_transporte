<?php

namespace App\Services;

use App\Models\Type;

class TypeService
{
    public static function getByAdminId()
    {
        // dd(Type::where('name', 'admin')->first()->id);
        return Type::where('name', 'admin')->first();
    }
}
