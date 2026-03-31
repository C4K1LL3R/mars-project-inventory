<div> 
    @if (session()->has('error'))
        <div wire:key="error-{{ now() }}" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)" 
             x-transition.duration.500ms 
             class="fixed left-1/4 -translate-x-1/2 -translate-y-1/2 z-[9999] 
                    min-w-[320px] bg-red-100 border-2 border-red-200 text-red-700 px-8 py-6 
                    rounded-3xl shadow-2xl text-sm font-bold flex flex-col items-center gap-3 animate-bounce">
            <span class="text-2xl"></span>
            <span class="text-center">{{ session('error') }}</span>
        </div>
    @endif

    @if (session()->has('success'))
        <div wire:key="success-{{ now() }}" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)" 
             x-transition.duration.500ms 
             class="fixed left-1/4 -translate-x-1/2 -translate-y-1/2 z-[9999] 
                    min-w-[320px] bg-green-100 border-2 border-green-200 text-green-700 px-8 py-6 
                    rounded-3xl shadow-2xl text-sm font-bold flex flex-col items-center gap-3">
            <span class="text-2xl"></span>
            <span class="text-center">{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('low_stock_alert'))
    <div wire:key="stock-alert-{{ microtime() }}"
         x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 8000)" 
         x-transition.duration.500ms 
         class="fixed bottom-10 right-10 z-[9999] min-w-[250px] bg-orange-50 border-2 border-orange-200 text-orange-700 px-4 py-3 rounded-2xl shadow-xl text-xs font-bold flex items-center gap-3 animate-pulse">
        <span class="text-lg"></span>
        <div>
            <p class="uppercase text-[10px] opacity-70">Aviso de Auditoria</p>
            <p>{{ session('low_stock_alert') }}</p>
        </div>
    </div>
@endif
    <div class="bg-slate-100 border border-slate-200 p-6 rounded-2xl mb-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
            
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pesquisar:</label>
                <input type="text" wire:model.live="search" placeholder="iPhone, SKU, Barcode..." 
                    class="bg-white border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500/20">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Categoria:</label>
                <select wire:model.live="category_id" class="bg-white border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="">Todas</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Preço (€):</label>
                <div class="flex gap-2">
                    <input type="number" wire:model.live="min_price" placeholder="Min" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm outline-none">
                    <input type="number" wire:model.live="max_price" placeholder="Max" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-sm outline-none">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Disponibilidade:</label>
                <select wire:model.live="in_stock" class="bg-white border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500/20">
                    <option value="">Todos</option>
                    <option value="true">Em Stock</option>
                    <option value="false">Esgotado</option>
                </select>
            </div>
        </div>

        @if($category_id || $search || $min_price || $max_price || $in_stock !== '')
            <div class="mt-4 flex justify-end">
                <button wire:click="resetFilters" class="text-xs font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest transition-all">
                    × Limpar todos os filtros
                </button>
            </div>
        @endif
    </div>

    <div class="bg-slate-50 border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-100 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Produto</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Categoria</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Stock</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Preço</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Remover</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse($products as $p)                 
                    <x-product-row :product="$p" :key="$p->id" />
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-medium">
                            Nenhum produto encontrado com os filtros selecionados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>