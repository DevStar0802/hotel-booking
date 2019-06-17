<?php

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
          'name' => 'Standard'
        ]);
        RoomType::create([
          'name' => 'Especial'
        ]);
        RoomType::create([
          'name' => 'Pro'
        ]);
        RoomType::create([
          'name' => 'Deluxe'
        ]);
    }
}
