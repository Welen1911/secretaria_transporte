<?php

namespace App\Services;

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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('http://api-gerenciador-publico.com.br/api/usuario/dados-usuario');

        if (!$response->ok()) {
            throw new Exception('response error', 401);
        }

        $userLogged = $response->object();

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
