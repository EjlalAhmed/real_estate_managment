<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'floor_number',
    ];

    // Floor ➜ Apartment
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    // Floor ➜ Rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
