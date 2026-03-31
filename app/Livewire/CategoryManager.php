<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{

    public $new_category_name;
    public $new_category_description;
    protected $rules = [
        'new_category_name' => 'required|string|min:3|unique:categories,name',
        'new_category_description' => 'nullable|string|max:255'
    ];

    public function createCategory()
    {
        $this->validate();
        
        Category::create([
            'name' => $this->new_category_name,
            'description' => $this->new_category_description ?? ''
        ]);

        $this->reset('new_category_name');
        $this->reset('new_category_description');

        $this->dispatch('category-updated'); 
        
        session()->flash('cat_success', 'Categoria criada com sucesso!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            session()->flash('cat_error', 'Não é possível apagar uma categoria que tem produtos!');
            return;
        }

        $category->delete();
        $this->dispatch('category-updated');
        
          session()->flash('cat_success', 'Categoria apagada com sucesso!');
    }

    public function render()
    {
        return view('livewire.categories_management', [
        
            'categories' => Category::withCount('products')->get()
        ]);
    }
}