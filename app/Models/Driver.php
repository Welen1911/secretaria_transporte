<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'status',
        'category',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }
}
