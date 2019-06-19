<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(Customer::class, function (Faker $faker)  use ($autoIncrement){
  $autoIncrement->next();
    return [
      'user_id' => $autoIncrement->current(),
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'address' => $faker->address,
      'city' => $faker->city,
      'country' => $faker->country,
      'phone' => $faker->phoneNumber,
      'fax' => $faker->phoneNumber,
      'email' => $faker->email,
    ];
});

function autoIncrement()
{
    for ($i = 8; $i < 20; $i++) {
        yield $i;
    }
}
