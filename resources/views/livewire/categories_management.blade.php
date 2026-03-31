
  <div class="p-6">  
    <div class="bg-slate-100 border border-slate-200 p-6 rounded-2xl shadow-2xl h-fit sticky top-8">
        <h2 class="text-xl font-bold mb-4 text-slate-700 border-b pb-2">Gestão de Categorias</h2>
        
        @if(session()->has('cat_error'))
            <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)" 
         x-transition.duration.500ms class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 text-xs font-bold">{{ session('cat_error') }}</div>
        @endif
        @if(session()->has('cat_success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)" 
         x-transition.duration.500ms class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 text-xs font-bold animate-bounce">
         {{ session('cat_success') }}
    </div>
    @endif

        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-semibold text-slate-500 uppercase">Nova Categoria</label>
                <div class="flex gap-2">
                    <input type="text" wire:model.blur="new_category_name" class="flex-1 bg-white border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500/20">
                    
                     </div>
                  <label class="text-xs font-semibold text-slate-500 uppercase">Descrição</label>
                 <div class="flex gap-2">
                    <input type="text" wire:model.blur="new_category_description" class="flex-1 bg-white border border-slate-300 rounded-xl px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500/20">
                 
                    </div>
                         <button wire:click="createCategory" class="bg-blue-600 text-white flex-1 px-6 rounded-xl font-bold hover:bg-blue-700 p-2 mb-10">Adicionar</button>
            
                 <label class="text-xs font-semibold text-slate-500 uppercase block">Categorias Atuais</label>
                  @foreach($categories as $cat)
                    <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-slate-200 shadow-sm mb-2">
                        <span class="text-slate-700 font-medium">{{ $cat->name }}</span>
                        
                        @if($cat->products_count > 0)
                            <span class="text-[10px] font-bold text-slate-400 uppercase bg-slate-50 px-2 py-1 rounded-md">
                                🔒 {{ $cat->products_count }} Prods
                            </span>
                        @else
                            <button wire:click="deleteCategory({{ $cat->id }})" wire:confirm="Tens a certeza?" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-all">
                                X
                            </button>
                            
                        @endif
                    </div>
                @endforeach
            </div>
                    </div></div>
                             <div class="space-y-2 max-h-48 overflow-y-auto pr-2">     </div>
    </div>
