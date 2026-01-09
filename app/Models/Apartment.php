<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    // Apartment ➜ Floors
    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}
