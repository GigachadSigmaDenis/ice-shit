<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skate extends Model
{
    use HasFactory;

    protected $fillable = ['model','size','quantity'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}