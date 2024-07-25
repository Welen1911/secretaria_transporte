<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoMobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'plate',
        'model',
        'capacity',
    ];

    public function routes() {
        return $this->hasMany(Route::class);
    }

}
