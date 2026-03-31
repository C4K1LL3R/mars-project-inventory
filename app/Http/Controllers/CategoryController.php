<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        return response()->json(Category::all());
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'description' => 'nullable|string'
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    // GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::with('products')->find($id);
        return $category ? response()->json($category) : response()->json(['m' => 'Não encontrada'], 404);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->products()->count() > 0) {
            return response()->json(['m' => 'Não podes apagar categorias com produtos'], 422);
        }

        $category->delete();
        return response()->json(['message' => 'Categoria eliminada']);
    }
}