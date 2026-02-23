<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','full_name','phone','hours','skate_id','paid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skate()
    {
        return $this->belongsTo(Skate::class);
    }
}