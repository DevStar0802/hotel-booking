<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
      'name',
      'addres',
      'city',
      'state',
      'country',
      'zip_code',
      'phone',
      'email',
      'image',
    ];
}
