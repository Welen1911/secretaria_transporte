<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\Http;

class CheckApiToken
{
    public static function check(string $token)
    {   
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get(env('ADMIN_URL'));
    
            if (!$response->ok()) {
                throw new Exception('response error', 401);
            }
    
            return $response->object();
        } catch (\Throwable $th) {
            return (object) [
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ];
        }
    }
}
