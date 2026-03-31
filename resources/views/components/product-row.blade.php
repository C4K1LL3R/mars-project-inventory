@props(['product'])

<tr class="hover:bg-blue-50/50 transition-colors border-b border-slate-100">
    <td class="px-6 py-4">
        <div class="font-bold text-slate-700">{{ $product->name }}</div>
        <div class="text-xs text-slate-400 italic">SKU: {{ $product->sku }}</div>
    </td>
    <td class="px-6 py-4 text-center">
        <span class="text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded-md border border-slate-200">
            {{ $product->category->name ?? 'Sem Categoria' }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        <span class="px-3 py-1 rounded-full text-sm font-bold {{ $product->stock < 10 ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
            {{ $product->stock }} unid.
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        <span class="px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-600">
            {{ number_format($product->price, 2, ',', '.') }} €
        </span>
    </td>
    <td class="px-6 py-4 text-right">
        <button 
            wire:click="deleteProduct({{ $product->id }})" 
            wire:confirm="Tens a certeza que queres eliminar o produto '{{ $product->name }}' do inventário?"
            class="text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-all"
            title="Eliminar Produto"
        >
            <span class="text-lg text-red-500">X</span>
</span>
        </button>
    </td>
</tr>