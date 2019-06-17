<?php

use App\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hotel::create([
          'name' => 'BestHotel',
          'addres' => '25 random street',
          'city' => 'New York',
          'state' => 'New York',
          'country' => 'United States',
          'zip_code' => 'xxxxx',
          'phone' => '0000000000',
          'email' => 'admin@besthotel.com',
          'image' => '/images/hotel.png',
        ]);
    }
}
