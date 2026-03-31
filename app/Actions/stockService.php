<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\StockMovement;

class StockService
{
    public function registerMovement($productId, $quantity, $type, $note = null)
    {
        $product = Product::findOrFail($productId);

        // Validação de stock insuficiente
        if ($type === 'out' && $product->stock < $quantity) {
            throw new \Exception('Stock insuficiente!');
        }

        // Criar o movimento
        StockMovement::create([
            'product_id' => $productId,
            'quantity'   => $quantity,
            'type'       => $type,
            'note'       => $note
        ]);

        // Atualizar o produto
        $type === 'in' 
            ? $product->increment('stock', $quantity) 
            : $product->decrement('stock', $quantity);

        return $product;
    }
}