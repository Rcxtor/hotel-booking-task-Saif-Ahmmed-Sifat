<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $fillable = [
        'category', 'base_price'
    ];

    // protected static function booted()
    // {
    //    function (RoomCategory $RoomCategory) {
    //         if (is_null($RoomCategory->price)) {
    //             $RoomCategory->price = self::price_set($RoomCategory->RoomCategory);
    //         }
    //     };
    // }
    // protected static function price_set(string $RoomCategory): float
    // {
    //     return match ($RoomCategory) {
    //         'Premium Deluxe' => 12000.00,
    //         'Super Deluxe'   => 8000.00,
    //         'Standard Deluxe' => 5000.00,
    //         default          => 0.00,
    //     };
    // }

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
