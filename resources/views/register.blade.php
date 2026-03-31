<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo - Mars Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900 font-sans min-h-screen p-4 flex items-center justify-center">

    <div class="max-w-md w-full mx-auto"> 
        <header class="text-center mb-8"> 
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-200">
                Criar Conta
            </h1>
            <p class="text-slate-400 mt-2 italic">Junta-te ao Mars Project</p>
        </header>

        <div class="bg-slate-700 border border-slate-200 p-8 rounded-2xl shadow-2xl">
            <form action="{{ url('/register') }}" method="POST" class="flex flex-col gap-5">
                @csrf 
                
                {{-- Nome --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Nome Completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-blue-500 focus:border-2" 
                        placeholder="O teu nome">
                    @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Endereço de Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-blue-500 focus:border-2" 
                        placeholder="exemplo@email.com">
                    @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Password</label>
                    <input type="password" name="password" required 
                        class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-blue-500 focus:border-2" 
                        placeholder="******">
                    @error('password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Confirmação de Password  --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Confirmar Password</label>
                    <input type="password" name="password_confirmation" required 
                        class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-blue-500 focus:border-2" 
                        placeholder="******">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition-all">
                    Registar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-slate-300 text-sm">Já tens conta? <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Faz login aqui</a></p>
            </div>
        </div>
    </div>

</body>
</html>