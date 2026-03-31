<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Actions\StockService; 
use App\Jobs\AuditStockMovement;

class StockMovement extends Component
{
    public $product_id;
    public $quantity;
    public $type = 'in'; 

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'type'       => 'required|in:in,out',
    ];

    public function save(StockService $stockService)
    {
        $this->validate();

        try {
            // Regista o movimento
            $stockService->registerMovement(
                $this->product_id,
                $this->quantity,
                $this->type,
                'Movimentação via Dashboard Livewire'
            );

            $product = Product::findOrFail($this->product_id);

            // Job de Auditoria
            AuditStockMovement::dispatch([
                'product_name'  => $product->name,
                'current_stock' => $product->stock,
            ]);


            if ($product->stock < 5) {
                session()->flash('low_stock_alert', "Aviso: O stock de {$product->name} está crítico ({$product->stock} un)!");
            }

            $this->reset(['quantity', 'type', 'product_id']);
            $this->dispatch('product-updated');
            session()->flash('sucesso', 'Stock atualizado com sucesso!');

        } catch (\Exception $e) {
            $this->addError('quantity', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.stock_movement', [
            'products' => Product::orderBy('name')->get()
        ]);
    }
}