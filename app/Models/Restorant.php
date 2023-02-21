<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restorant extends Model
{
    use HasFactory;

    public function restorantDishes()
    {
        return $this->hasMany(Dish::class, 'restorant_id', 'id');
    }
}
