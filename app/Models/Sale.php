<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'customer_name', 'total_amount', 'sale_date'];

    protected $casts = ['sale_date' => 'date', 'total_amount' => 'decimal:2'];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
