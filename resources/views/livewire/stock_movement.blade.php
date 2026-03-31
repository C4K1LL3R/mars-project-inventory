<div class="bg-slate-100 border border-slate-200 p-6 rounded-2xl shadow-2xl h-fit sticky top-8">
    
    <div>
        {{-- Sucesso Centralizado --}}
        @if (session()->has('sucesso'))
            <div wire:key="suc-{{ microtime() }}" 
                 x-data="{ show: true }" x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)" 
                 x-transition.duration.500ms 
                 class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[9999] min-w-[300px] bg-white border-2 border-green-500 p-6 rounded-3xl shadow-2xl text-center flex flex-col items-center gap-2">
                <span class="text-3xl"></span>
                <span class="font-bold text-slate-800">{{ session('sucesso') }}</span>
            </div>
        @endif

        @if (session()->has('low_stock_alert'))
            <div wire:key="stock-{{ microtime() }}" 
                 x-data="{ show: true }" x-show="show" 
                 x-init="setTimeout(() => show = false, 8000)" 
                 x-transition.duration.500ms 
                 class="fixed bottom-10 right-10 z-[9999] max-w-xs bg-amber-50 border-l-4 border-amber-500 p-4 shadow-2xl rounded-r-xl flex items-center gap-3 animate-bounce">
                <span class="text-2xl"></span>
                <p class="text-xs font-bold text-amber-800">{{ session('low_stock_alert') }}</p>
                <button @click="show = false" class="text-amber-400 font-bold ml-2">×</button>
            </div>
        @endif
    </div>

    <h2 class="text-xl font-bold mb-4 text-slate-700 border-b border-slate-200 pb-2">Movimentar Stock</h2>
    
    <form wire:submit.prevent="save" class="flex flex-col gap-5">
        
        <div class="flex flex-col gap-1">
            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selecionar Produto</label>
            <select wire:model.live="product_id" class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all cursor-pointer">
                <option value="">Selecione um produto...</option>
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} (Atual: {{ $p->stock }})</option>
                @endforeach
            </select>
            @error('product_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Quantidade</label>
            <input type="number" wire:model.live="quantity" min="1" 
                class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
            @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipo de Operação</label>
            <div class="flex gap-2">
                <label class="flex-1 cursor-pointer">
                    <input type="radio" wire:model.live="type" value="in" class="hidden peer">
                    <div class="text-center p-3 rounded-xl border border-slate-300 font-bold text-slate-500 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition-all shadow-sm">
                        Entrada
                    </div>
                </label>
                <label class="flex-1 cursor-pointer">
                    <input type="radio" wire:model.live="type" value="out" class="hidden peer">
                    <div class="text-center p-3 rounded-xl border border-slate-300 font-bold text-slate-500 peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600 transition-all shadow-sm">
                        Saída
                    </div>
                </label>
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled" class="bg-slate-700 p-4 rounded-2xl text-white hover:bg-slate-800 transition-colors">
            <span wire:loading.remove>CONFIRMAR MOVIMENTO</span>
            <span wire:loading>A PROCESSAR...</span>
        </button>
    </form>
</div>