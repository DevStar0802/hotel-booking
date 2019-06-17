<?php

use App\Models\RoomCapacity;
use Illuminate\Database\Seeder;

class RoomCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomCapacity::create([
          'name'=>'Single'
        ]);
        RoomCapacity::create([
          'name'=>'Double'
        ]);
        RoomCapacity::create([
          'name'=>'Triple'
        ]);
        RoomCapacity::create([
          'name'=>'Family'
        ]);
    }
}
