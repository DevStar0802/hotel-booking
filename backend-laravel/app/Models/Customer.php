<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'user_id',
      'first_name',
      'last_name',
      'address',
      'city',
      'country',
      'phone',
      'fax',
      'email',
    ];
    const VALIDATOR_OPTIONS = [
      'user_id' => '',
      'first_name' => 'required',
      'last_name' => 'required',
      'address' => '',
      'city' => '',
      'country' => '',
      'phone' => 'required',
      'fax' => '',
      'email' => 'required',
    ];
}
