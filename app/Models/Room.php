<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Room extends Model
{

    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = [
        'room_number', 'room_category_id', 'image_path'
    ];

    public function roomcategory()
    {
        return $this->belongsTo(RoomCategory::class,'room_category_id');
    }
}
