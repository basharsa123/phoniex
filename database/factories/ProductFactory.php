<?php

namespace Database\Factories;

use App\Models\brands;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
            $files = \Illuminate\Support\Facades\File::files("C:\Users\ssawa\OneDrive\Pictures\Screenshots/");
            $random_file = collect($files)->shuffle()->take(6);
            $random_file->map(function ($file) {
                return [
                  "name" => $file->getFilename(),
                ];
            });
        return [
            "name" => $this->faker->name(),
            "category_id" => Categories::all()->random()->id,
            "brand_id" => Brands::all()->random()->id,
            "amount" => $this->faker->randomNumber( 3),
            "price" => $this->faker->randomFloat(2, 100,5000),
            "discount" => $this->faker->randomNumber(2),
            "is_trendy" => $this->faker->boolean(),
            "is_available" => $this->faker->boolean(),
            "image" => $random_file->random(),
        ];
    }
}
