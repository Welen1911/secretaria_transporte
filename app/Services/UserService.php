<?php

namespace App\Services;

use App\Actions\CheckApiToken;
use App\Models\Employee;
use App\Models\User;
use App\Utils\GetByMatricula;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Event\Code\Throwable;

class UserService
{

    public static function indexByDriver()
    {
        return DB::table('users')
            ->leftJoin('drivers', 'users.id', '=', 'drivers.id')
            ->whereNull('drivers.id')
            ->select('users.*')
            ->where('users.type', null)
            ->get();
    }


    public static function getByMatricula(string $matricula)
    {
        return DB::select('SELECT * FROM p_user_matricula(?)', [$matricula]);
    }

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
                'type' => $userLogged->roles[0] == 'ROLE_ADMIN' ? 'admin' : null
            ]);
        }

        $token = Auth::login($user);

        return $token;
    }
}
