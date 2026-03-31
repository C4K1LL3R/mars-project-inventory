  <div class="bg-slate-100 border border-slate-200 p-6 rounded-2xl shadow-2xl h-fit sticky top-8">
        <h2 class="text-xl font-bold mb-4 text-slate-700 border-b pb-2">Registar Novo Produto</h2>
        
        <form wire:submit.prevent="saveProduct" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-1 md:col-span-2">
                <label class="text-xs font-semibold text-slate-500 uppercase">Nome Completo</label>
                <input type="text" wire:model.live="name" 
                class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
            </div>

          <div class="flex flex-col gap-1">
    <label class="text-xs font-semibold text-slate-500 uppercase">SKU (Código Interno)</label>
    
    <input type="text" wire:model="sku" 
        placeholder="EX: IPH-15-PRETO"
        class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all uppercase">
    
    @error('sku') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
</div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-slate-500 uppercase">Categoria</label>
                <select wire:model="category_id" class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
                    <option value="">Escolher...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-slate-500 uppercase">Preço de Venda (€)</label>
                <input type="number" step="0.01" wire:model="price" class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-slate-500 uppercase">Stock Inicial</label>
                <input type="number" wire:model="stock" class="bg-white border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all">
            </div>

            <button type="submit" class="md:col-span-2 bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-2xl transition-all shadow-lg mt-4">
                ADICIONAR PRODUTO AO MARS PROJECT
            </button>
        </form>
    </div>