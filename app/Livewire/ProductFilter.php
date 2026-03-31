<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductFilter extends Component
{

    public $category_id = '';
    public $min_price = '';
    public $max_price = '';
    public $in_stock = ''; 
    public $search = '';

    protected $listeners = ['product-updated' => '$refresh'];

    public function render()
    {
        $categories = Category::all();

   
        $products = Product::with('category')
            // Filtro Categoria
            ->when($this->category_id, function($q) {
                $q->where('category_id', $this->category_id);
            })
            // Filtro Preço Mínimo
            ->when($this->min_price, function($q) {
                $q->where('price', '>=', $this->min_price);
            })
            // Filtro Preço Máximo
            ->when($this->max_price, function($q) {
                $q->where('price', '<=', $this->max_price);
            })
            // Filtro Stock 
            ->when($this->in_stock !== '', function($q) {
                if ($this->in_stock === 'true') $q->where('stock', '>', 0);
                if ($this->in_stock === 'false') $q->where('stock', '<=', 0);
            })
            // Filtro: Pesquisa (Nome, SKU, Barcode)
            ->when($this->search, function($q) {
                $q->where(function($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('sku', 'like', '%' . $this->search . '%')
                        ->orWhere('barcode', 'like', '%' . $this->search . '%');
                });
            })
            ->get();

        return view('livewire.product-filter', [
            'products' => $products,
            'categories' => $categories
        ]);
        
    }
    public function resetFilters()
{
    $this->reset(['category_id', 'search', 'min_price', 'max_price', 'in_stock']);
}
public function deleteProduct($id)
{
    $product = \App\Models\Product::findOrFail($id);
    
    if ($product->stock > 0) {session()->flash('error', "Não podes eliminar o produto '{$product->name}' porque ainda tem {$product->stock} unidades em stock!");
        return;}

    $product->delete();
    $this->dispatch('product-updated');
    session()->flash('message', 'Produto removido com sucesso.');
}
}
