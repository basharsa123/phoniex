<?php

namespace Database\Factories;

use App\Models\order;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_items>
 */
class Order_itemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "order_id" => Order::all()->random()->id,
            "quantity" => $this->faker->numberBetween(1, 10),
            "price" => $this->faker->numberBetween(100, 10000),
            "product_id" => product::all()->random()->id,
        ];
    }
}
