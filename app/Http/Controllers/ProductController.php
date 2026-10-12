<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'categories' => Category::orderBy('name')->get(),
            'suppliers'  => Supplier::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:50|unique:products,sku',
            'price'          => 'required|numeric|min:0|max:99999999.99',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'supplier']);

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product'    => $product,
            'categories' => Category::orderBy('name')->get(),
            'suppliers'  => Supplier::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price'          => 'required|numeric|min:0|max:99999999.99',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (QueryException $e) {
            return redirect()->route('products.index')
                ->with('error', 'This product has sales records and cannot be deleted.');
        }

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
