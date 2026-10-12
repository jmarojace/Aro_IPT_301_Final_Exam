<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::withCount('items')->latest('sale_date')->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        return view('sales.create', [
            'products' => Product::where('stock_quantity', '>', 0)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'        => 'nullable|string|max:255',
            'sale_date'            => 'required|date',
            'items'                => 'required|array|min:1',
            'items.*.product_id'   => 'required|exists:products,id',
            'items.*.quantity'     => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $sale = Sale::create([
                'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5)),
                'customer_name'  => $validated['customer_name'] ?? null,
                'sale_date'      => $validated['sale_date'],
                'total_amount'   => 0,
            ]);

            $total = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if ($product->stock_quantity < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => "Not enough stock for {$product->name}. Available: {$product->stock_quantity}.",
                    ]);
                }

                $subtotal = round((float) $product->price * $item['quantity'], 2);
                $total += $subtotal;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal'   => $subtotal,
                ]);

                $product->decrement('stock_quantity', $item['quantity']);
            }

            $sale->update(['total_amount' => $total]);
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load('items.product');

        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $sale->load('items');
        $soldQuantities = $sale->items
            ->groupBy('product_id')
            ->map(fn ($items) => $items->sum('quantity'));
        $products = Product::orderBy('name')->get();
        $products->each(function (Product $product) use ($soldQuantities): void {
            $product->available_for_sale = $product->stock_quantity + ($soldQuantities[$product->id] ?? 0);
        });

        return view('sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'sale_date'     => 'required|date',
            'items'                => 'required|array|min:1',
            'items.*.product_id'   => 'required|exists:products,id',
            'items.*.quantity'     => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated, $sale): void {
            $lockedSale = Sale::lockForUpdate()->findOrFail($sale->id);

            foreach ($lockedSale->items as $existingItem) {
                Product::whereKey($existingItem->product_id)->increment('stock_quantity', $existingItem->quantity);
            }

            $lockedSale->items()->delete();
            $total = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if ($product->stock_quantity < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => "Not enough stock for {$product->name}. Available: {$product->stock_quantity}.",
                    ]);
                }

                $subtotal = round((float) $product->price * $item['quantity'], 2);
                $lockedSale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);
                $product->decrement('stock_quantity', $item['quantity']);
                $total += $subtotal;
            }

            $lockedSale->update([
                'customer_name' => $validated['customer_name'] ?? null,
                'sale_date' => $validated['sale_date'],
                'total_amount' => $total,
            ]);
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale and its items updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            // Return the stock before removing the sale.
            foreach ($sale->items as $item) {
                Product::where('id', $item->product_id)
                    ->increment('stock_quantity', $item->quantity);
            }

            $sale->delete(); // sale_items are removed by cascadeOnDelete
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted and stock restored.');
    }
}
