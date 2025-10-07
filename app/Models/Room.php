<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number', 'room_category_id', 'image_path'
    ];

    public function roomcategory()
    {
        return $this->BelongsTo(RoomCategory::class);
    }
}
