<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brands = [
            [
                "name" => "Audi",
                "models" => [
                    "Q8",
                    "Q7",
                    "A7",
                    "A6",
                    "A4",
                    "A3",
                    "A1",
                ],
            ],
            [
                "name" => "Volkswagen",
                "models" => [
                    "Golf",
                    "Polo",
                    "Touareg",
                    "Passat",
                ],
            ],
            [
                "name" => "Škoda",
                "models" => [
                    "Superb",
                    "Fabia",
                    "Octavia",
                    "Kamiq",
                ],
            ],
            [
                "name" => "Fiat",
                "models" => [
                    "Punto",
                ],
            ]
        ];

        $v_type = ['SUV', 'Truck', 'Sedan', 'Caravan', 'Coupe', 'Family','Car'];
        $engines = [1.0, 1.6, 2.0, 2.2, 2.4, 3.0, 3.2, 4.2, 5.0];

        $randomBrand = $this->faker->randomElement($brands);
        $randomModel = $this->faker->randomElement($randomBrand["models"]);

        return [
            'is_available' => 1,
            'vehicle_image' => null,
            'name' => $randomBrand["name"] . " - " . $randomModel,
            'brand' => $randomBrand["name"],
            'model' => $randomModel,
            'year_model' => $this->faker->year,
            'mileage_km' => $this->faker->numberBetween(50.000, 200.000),
            'vehicle_type' => $this->faker->randomElement($v_type),
            'vehicle_category' => $this->faker->bloodType,
            'registration_number' => $this->faker->bankAccountNumber,
            'engine_capacity' => $this->faker->randomElement($engines),
            'power_kw' => $this->faker->numberBetween(70, 300),
        ];
    }
}
