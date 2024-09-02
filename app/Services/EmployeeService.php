<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{

    public static function storeAdmin($user_id, $cpf = '000')
    {
        $employee = Employee::create([
            'user_id' => $user_id,
            'cpf' => $cpf,
        ]);

        return $employee;
    }
}
