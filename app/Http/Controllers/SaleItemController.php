<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;

class SaleItemController extends Controller
{

    public function index()
    {
        $items = SaleItem::with(['sale', 'product'])->latest()->paginate(15);

        return view('sale-items.index', compact('items'));
    }

    public function show(SaleItem $saleItem)
    {
        $saleItem->load(['sale', 'product']);

        return view('sale-items.show', compact('saleItem'));
    }
}