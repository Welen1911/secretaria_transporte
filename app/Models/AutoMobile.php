<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutoMobile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'year',
        'plate',
        'model',
        'capacity',
    ];

    public function routes() {
        return $this->hasMany(Route::class);
    }

}
