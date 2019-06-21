<?php

use Illuminate\Database\Seeder;

use App\Models\Price;
class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this factory was just for crud frontend tests.
        //factory(Price::class, 20)->create();

        //Im gonna set general prices for all rooms.
        for ($i=1; $i < 5; $i++) {
          for ($j=1; $j < 5; $j++) {
            Price::create([
              'name' => 'general-price-'.rand(1,1500),
              'price' => rand(1,2500),
              'room_type_id' => $i,
              'room_capacity_id' => $j,
              'day' => 'all',
              'start_date' => null,
              'end_date' => null
            ]);
          }
        }

    }
}
