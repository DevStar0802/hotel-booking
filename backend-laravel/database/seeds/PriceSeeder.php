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
        factory(Price::class, 20)->create();
    }
}
