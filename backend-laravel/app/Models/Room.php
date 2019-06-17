<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'name', 'room_type_id', 'room_capacity_id', 'image'
    ];
}
