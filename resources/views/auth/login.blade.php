<x-guest-layout>

    <h1 class="text-xl font-bold mb-1">Ingresar</h1>
    <p class="text-gray-500 text-sm mb-6">Bienvenido de vuelta. Continúa aprendiendo.</p>

    {{-- Status (reset password) --}}
    @if (session('status'))
        <div class="mb-5 mono text-xs text-emerald-400 bg-emerald-400/10 border border-emerald-400/20 rounded-xl px-4 py-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">
                Correo electrónico
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">
                Contraseña
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('password') border-red-500 @enderror">
            @error('password')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember"
                       class="w-4 h-4 rounded bg-gray-800 border border-white/10 text-cyan-500
                              focus:ring-cyan-500 focus:ring-offset-gray-900">
                <span class="text-sm text-gray-400">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-xl
                       transition-colors text-sm shadow-lg shadow-cyan-500/20">
            Ingresar →
        </button>
    </form>

    {{-- Register link --}}
    <p class="text-center text-sm text-gray-500 mt-6">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
            Regístrate gratis
        </a>
    </p>

</x-guest-layout>
