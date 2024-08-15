<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'status',
        'category',
    ];

    public function routes() {
        return $this->hasMany(Route::class);
    }
}
