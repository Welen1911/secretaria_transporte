<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteTurn extends Model
{
    use HasFactory;

    public function turn() {
        return $this->belongsTo(Turn::class);
    }
}
