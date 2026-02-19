<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function room() {
        return $this->hasOne('App\Models\RoomType', 'id', 'room_type_id');
    }

}
