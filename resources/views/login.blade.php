<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mars Project</title>
    <script src="https://cdn.tailwindcss.com"></script> </head>
<body class="bg-slate-100 text-slate-900 font-sans min-h-screen p-4 flex items-center justify-center">

    <div class="max-w-md w-full mx-auto"> 
        <header class="text-center mb-8"> 
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-200">
    Login
</h1>
            <p class="text-slate-400 mt-2 italic">Bem-vindo de volta ao Mars Project</p>
        </header>

        <div class="bg-slate-700 border border-slate-200 p-8 rounded-2xl shadow-2xl">
      @if ($errors->has('email'))
    <div 
        
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-5 rounded-xl animate-pulse" 
        role="alert"
    >
        <p class="text-sm font-bold">Erro de Acesso</p>
        <p class="text-xs">{{ $errors->first('email') }}</p>
    </div>
@endif  
        <form action="{{ url('/login') }}" method="POST" class="flex flex-col gap-5">
                @csrf 
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Endereço de Email</label>
                    <input type="email" name="email" required class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-blue-500 focus:border-2" placeholder="exemplo@email.com" >
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-100 uppercase">Password</label>
                    <input type="password" name="password" required class="bg-white border border-slate-300 rounded-xl px-4 py-3 outline-none  focus:border-blue-500 focus:border-2" placeholder="******">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition-all">
                    Entrar
                </button>
                
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-slate-300 text-sm">Ainda não tens conta? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Regista-te aqui</a></p>
            </div>
        </div>
    </div>

</body>
</html>