<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\On; 

class ProductManager extends Component
{
   
    public $name, $sku, $barcode, $category_id, $price, $stock = 0;

  
    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|unique:products,sku',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'barcode' => 'nullable|string|max:100',
    ];


    #[On('category-updated')]
    public function refreshCategories()
    {
    }

    public function saveProduct()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'sku' => strtoupper($this->sku), 
            'barcode' => $this->barcode,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        $this->reset(['name', 'sku', 'barcode', 'category_id', 'price', 'stock']);


        $this->dispatch('product-updated');

        session()->flash('prod_success', 'Produto registado no Mars Project!');
        $this->dispatch('product-updated');
    }

    public function render()
    {
        return view('livewire.products_management', [
            'categories' => Category::orderBy('name')->get()
        ]);
    }
}