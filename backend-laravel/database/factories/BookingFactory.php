<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
      'room_id' => rand(1,15),
      'start_date'=> $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 years', $timezone = null),
      'end_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 years', $timezone = null),
      'customer_id' => rand(1,10),
    ];
});
