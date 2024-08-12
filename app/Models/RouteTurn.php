<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteTurn extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'turn_id',
    ];

    public function turn() {
        return $this->belongsTo(Turn::class);
    }
}
