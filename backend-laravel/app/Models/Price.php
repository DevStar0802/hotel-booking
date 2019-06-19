<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public $fillable = [
      'name',
      'price',
      'room_type_id',
      'room_capacity_id',
      'day',
      'start_date',
      'end_date'
    ];
    const VALIDATOR_OPTIONS= [
      'name' => 'required',
      'room' => 'integer|min:1',
      'price' => 'required|numeric',
      'room_type_id' => 'required|integer|min:1',
      'room_capacity_id' => 'required|integer|min:1',
      'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday,all',
      'start_date' => 'date',
      'end_date' => 'date'
    ];
}
