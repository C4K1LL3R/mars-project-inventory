<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    // Executa ANTES de o produto ser apagado
    public function deleting(Product $product)
    {
        Log::info("O produto {$product->name} (SKU: {$product->sku}) está a ser removido por " . auth()->user()->name);
    }

    // Executa DEPOIS de um produto ser criado
    public function created(Product $product)
    {
        if (!$product->sku) {
            $product->update(['sku' => 'TEMP-' . $product->id]);
        }
    }
}