<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

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
