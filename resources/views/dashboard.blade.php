<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mars Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-white text-slate-900 font-sans min-h-screen p-8" x-data="{ aba: 'movimentar' }">

    <div class="max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">
                    Mars Project Inventário
                </h1>
                <p class="text-slate-400 italic">Gestão de Stock em Tempo Real</p>
            </div>
            
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl"> 
                    Sair do Sistema 
                </button>
            </form>
        </header>

        <div class="mb-10 max-w-1xl">
            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 block">O que deseja fazer?</label>
            <div class="flex gap-2">
    <button @click="aba = 'movimentar'" 
        :class="aba == 'movimentar' ? 'bg-blue-600 text-white border-blue-600 shadow-md' : 'bg-white text-slate-500 border-slate-300'"
        class="flex-1 p-3 rounded-xl border font-bold transition-all shadow-sm">
        Movimentar Stock
    </button>
    
    <button @click="aba = 'gestaoCategorias'" 
        :class="aba == 'gestaoCategorias' ? 'bg-blue-600 text-white border-blue-600 shadow-md' : 'bg-white text-slate-500 border-slate-300'"
        class="flex-1 p-3 rounded-xl border font-bold transition-all shadow-sm">
        Gerir Categorias
    </button>

    <button @click="aba = 'gestaoProdutos'" 
        :class="aba == 'gestaoProdutos' ? 'bg-blue-600 text-white border-blue-600 shadow-md' : 'bg-white text-slate-500 border-slate-300'"
        class="flex-1 p-3 rounded-xl border font-bold transition-all shadow-sm">
        Gerir Produtos
    </button>
</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2">
                @livewire('product-filter')
            </div>

            <div class="lg:col-span-1">
                <template x-if="aba == 'movimentar'">
                    <div>
                        @livewire('stock-movement')
                    </div>
                </template>
                <template x-if="aba == 'gestaoCategorias'">
                    <div>
                        @livewire('category-manager')
                    </div>
                </template>
                <template x-if="aba == 'gestaoProdutos'">
                    <div>
                        @livewire('product-manager')
                    </div>
                </template>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>