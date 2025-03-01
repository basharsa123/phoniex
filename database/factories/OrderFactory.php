<?php

namespace Database\Factories;

use App\Models\location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "status" => $this->faker->randomElement(["Canceled" , "Pending" , "Accepted", "Delivered"]),
            "user_id" =>User::all()->random()->id,
            "location_id"=> location::all()->random()->id,
            "total_price" => $this->faker->randomFloat(2, 100, 50000),
            "date_of_deliver" => $this->faker->date()
            ];
    }
}
