<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'name', 'room_type_id', 'room_capacity_id', 'image'
    ];
    const VALIDATOR_OPTIONS = [
      'name' => 'required',
      'room_type_id' => 'required|integer|min:1',
      'room_capacity_id' => 'required|integer|min:1',
      "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
    ];
}
