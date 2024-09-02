<?php

namespace App\Services;

use App\Actions\CheckApiToken;
use App\Models\Employee;
use App\Models\User;
use App\Utils\GetByMatricula;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PHPUnit\Event\Code\Throwable;

class UserService
{


    public static function store($token)
    {

        $userLogged = CheckApiToken::check($token);

        // dd($userLogged);

        $user = GetByMatricula::invoke($userLogged->matricula);

        if (!$user) {
            $user = User::create([
                'matricula' => $userLogged->matricula,
                'name' => $userLogged->nome,
                'email' => $userLogged->email,
            ]);

            if ($userLogged->roles[0] == 'ROLE_ADMIN') {
                EmployeeService::storeAdmin($user->id);
            }
        }

        $token = Auth::login($user);

        return $token;
    }
}
