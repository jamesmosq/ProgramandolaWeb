<x-guest-layout>

    <h1 class="text-xl font-bold mb-1">Recuperar contraseña</h1>
    <p class="text-gray-500 text-sm mb-6">
        Ingresa tu correo y te enviamos un enlace para restablecer tu contraseña.
    </p>

    @if (session('status'))
        <div class="mb-5 mono text-xs text-emerald-400 bg-emerald-400/10 border border-emerald-400/20 rounded-xl px-4 py-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">
                Correo electrónico
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus
                   placeholder="tu@correo.com"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-xl
                       transition-colors text-sm shadow-lg shadow-cyan-500/20">
            Enviar enlace de recuperación →
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">
            ← Volver al login
        </a>
    </p>

</x-guest-layout>
