<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'is_enabled',
        'image'
    ];

    public function autoMobiles()
    {
        return $this->hasMany(AutoMobile::class);
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}
