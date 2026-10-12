<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Product> */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'name' => fake()->unique()->words(3, true),
            'sku' => fake()->unique()->bothify('SKU-####-????'),
            'price' => fake()->randomFloat(2, 500, 150000),
            'stock_quantity' => fake()->numberBetween(10, 60),
        ];
    }
}
