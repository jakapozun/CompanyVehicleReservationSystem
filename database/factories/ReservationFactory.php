<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Symfony\Component\Translation\t;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $vehicles = Vehicle::all()->pluck('id')->toArray();

        return [
            'vehicle_id' => $this->faker->unique()->randomElement($vehicles),
            'user_id' => $this->faker->unique()->randomElement($users),
            'pickup_date' => $this->faker->dateTimeThisMonth,
            'dropoff_date' => $this->faker->dateTimeThisMonth,
            'destination' => $this->faker->city,
            'destination_km' => $this->faker->numberBetween(10,200),
            'pickup_location' => "Podjetje, parkirisce.",
            'dropoff_location' => "Podjetje, parkirisce.",
        ];
    }
}
