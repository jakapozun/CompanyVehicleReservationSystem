<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Vehicle::factory(10)->create();
//        Reservation::factory(10)->create();

    }
}
