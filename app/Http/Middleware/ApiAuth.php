<?php

namespace App\Http\Middleware;

use App\Actions\CheckApiToken;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $userLogged = CheckApiToken::check($request->header('Login-token'));

            if (isset($userLogged->status) && $userLogged->status == 401) {
                throw new Exception($userLogged->message, 401);
            }

            if ($userLogged->matricula != Auth::user()->matricula) {
                throw new Exception('response error', 401);
            }

        } catch (\Throwable $e) {
            return response($e->getMessage(), 401);
        }

        return $next($request);
    }
}
