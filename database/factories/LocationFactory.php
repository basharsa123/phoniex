<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $areas = [
          "Al-mohafaza","Halap al jadida", "jamilia" , "new amestrdam"
        ];
        return [
            "user_id" => User::all()->random()->id,
            "street" => $this->faker->streetName,
            "building" => $this->faker->buildingNumber,
            "area"=> $areas[array_rand($areas)],
        ];
    }
}
