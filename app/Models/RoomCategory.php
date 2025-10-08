<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RoomCategory extends Model
{
    use HasFactory;

    protected $table = 'room_categories';
    protected $fillable = [
        'category', 'base_price'
    ];

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
