<?php

namespace App\Http\Controllers;

use App\Jobs\AuditStockMovement;
use Illuminate\Http\Request;
use App\Actions\StockService; 
use App\Models\Product;
use Exception;

class StockMovementController extends Controller
{
    
    public function store(Request $request, StockService $stockService) 
    {
      
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required|in:in,out',
            'note'       => 'nullable|string|max:255'
        ]);

        try {

            $product = Product::findOrFail($request->product_id);

      
            $stockService->registerMovement(
                $request->product_id, 
                $request->quantity, 
                $request->type, 
                $request->note
            );

        
         AuditStockMovement::dispatch([
    'product_name'  => $product->name,
    'current_stock' => $product->stock,
    'user_id'       => auth()->id()
]);

            return back()->with('sucesso', 'Stock do ' . $product->name . ' atualizado com sucesso!');

        } catch (Exception $e) {

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {

    $movement = \App\Models\StockMovement::with('product')->findOrFail($id);

    return response()->json([
        'success' => true,
        'data' => $movement
    ]);
}
}