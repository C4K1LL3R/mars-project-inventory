<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
public function index(Request $request)
{
   
    $query = Product::with('category');

    // Filtro: Categoria
    $query->when($request->category_id, function ($q) use ($request) {
        return $q->where('category_id', $request->category_id);
    });

    // Filtro: Preço Mínimo
    $query->when($request->min_price, function ($q) use ($request) {
        return $q->where('price', '>=', $request->min_price);
    });

    // Filtro: Preço Máximo
    $query->when($request->max_price, function ($q) use ($request) {
        return $q->where('price', '<=', $request->max_price);
    });

    // Filtro: Em Stock 
    $query->when($request->has('in_stock'), function ($q) use ($request) {
        if ($request->in_stock === 'true') {
            return $q->where('stock', '>', 0);
        } elseif ($request->in_stock === 'false') {
            return $q->where('stock', '<=', 0);
        }
    });

    // Filtro: Pesquisa (Nome, SKU ou Barcode)
    $query->when($request->search, function ($q) use ($request) {
        $search = $request->search;
        return $q->where(function ($sub) use ($search) {
            $sub->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('barcode', 'like', "%{$search}%");
        });
    });

    return response()->json($query->get());
}

    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'integer|min:0'
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json([
            'message' => 'Produto atualizado!',
            'data' => $product
        ]);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produto removido do sistema']);
    }
}