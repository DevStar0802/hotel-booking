<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->randomLetter.$faker->randomDigit,
        'room_type_id' =>rand(1,4),
        'room_capacity_id' => rand(1,4),
        'image' => '/images/no-room.png'
    ];
});
