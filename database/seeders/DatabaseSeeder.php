<?php

namespace Database\Seeders;

use App\Models\brands;
use App\Models\Categories;
use App\Models\location;
use App\Models\order;
use App\Models\order_items;
use App\Models\product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        brands::factory(4)->create();
        Categories::factory(3)->create();
        location::factory(10)->create();
        product::factory(10)->create();
        order::factory(2)->create();
        order_items::factory(10)->create();

//        $this->call(BrandsSeeder::class);
    }
}
