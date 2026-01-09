<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
    'floor_id',
    'room_number',
    'type',
    'price',
];

    // Room ➜ Floor
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    // Room ➜ Apartment (indirect, useful)
    public function apartment()
    {
        return $this->hasOneThrough(
            Apartment::class,
            Floor::class,
            'id',           // floors.id
            'id',           // apartments.id
            'floor_id',     // rooms.floor_id
            'apartment_id'  // floors.apartment_id
        );
    }

        public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}

