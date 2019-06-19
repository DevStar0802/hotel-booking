<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
  $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'all'];
    return [
      'name' => 'price-'.rand(1,1500),
      'price' => rand(1,2500),
      'room_type_id' => rand(1,4),
      'room_capacity_id' => rand(1,4),
      'day' => $days[rand(0,7)],
      'start_date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '+5 years', $timezone = null),
      'end_date' => $faker->dateTimeBetween($startDate = '--2 years', $endDate = '+5 years', $timezone = null),
    ];
});
