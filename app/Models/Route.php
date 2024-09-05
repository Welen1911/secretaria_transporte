<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'driver_id',
        'automobile_id',
        'capacity',
        'turn_id',
        'status',
        'start',
        'end'
    ];


    public function routeTurn() {
        return $this->hasMany(RouteTurn::class);
    }

    public function turn() {
        return $this->belongsTo(Turn::class);
    }
}
