<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $categories = Category::factory()->count(5)->create();
            $suppliers = Supplier::factory()->count(5)->create();

            for ($productNumber = 0; $productNumber < 30; $productNumber++) {
                Product::factory()->create([
                    'category_id' => $categories->random()->id,
                    'supplier_id' => $suppliers->random()->id,
                ]);
            }

            for ($saleNumber = 0; $saleNumber < 8; $saleNumber++) {
                $sale = Sale::factory()->create(['total_amount' => 0]);
                $total = 0;
                $products = Product::where('stock_quantity', '>', 0)
                    ->inRandomOrder()
                    ->limit(fake()->numberBetween(1, 3))
                    ->get();

                foreach ($products as $product) {
                    $quantity = fake()->numberBetween(1, min(3, $product->stock_quantity));
                    $subtotal = round((float) $product->price * $quantity, 2);

                    SaleItem::factory()->create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);

                    $product->decrement('stock_quantity', $quantity);
                    $total += $subtotal;
                }

                $sale->update(['total_amount' => $total]);
            }
        });
    }
}
