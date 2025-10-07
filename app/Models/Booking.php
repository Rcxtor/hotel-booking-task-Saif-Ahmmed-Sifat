<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'name','email','phone','room_category','room_id','total_price','check_in','check_out'  
      ];
    public function room()
      {
          return $this->BelongsTo(Room::class);
      }
    
    public function roomcategory()
    {
        return $this->BelongsTo(RoomCategory::class);
    }
}
