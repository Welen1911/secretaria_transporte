<?php

namespace App\Utils;

use App\Models\User;

class GetByMatricula {
    public static function invoke($token)
    {
        $user = User::where('matricula', $token)->first();

        return $user;
    }
}
