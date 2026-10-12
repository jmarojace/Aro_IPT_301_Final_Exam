<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Sale> */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'invoice_number' => 'INV-' . fake()->unique()->numerify('##########'),
            'customer_name' => fake()->optional()->name(),
            'total_amount' => 0,
            'sale_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
        ];
    }
}
