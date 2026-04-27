<x-guest-layout>

    <h1 class="text-xl font-bold mb-1">Crear cuenta</h1>
    <p class="text-gray-500 text-sm mb-4">Únete a EduCode y empieza a programar hoy.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nombre --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">
                Nombre completo
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="Tu nombre"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                Correo electrónico
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="tu@correo.com"
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
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">
                Contraseña
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   placeholder="Mínimo 8 caracteres"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('password') border-red-500 @enderror">
            @error('password')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">
                Confirmar contraseña
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   placeholder="Repite tu contraseña"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-xl
                       transition-colors text-sm shadow-lg shadow-cyan-500/20">
            Crear cuenta gratis →
        </button>
    </form>

    {{-- Login link --}}
    <p class="text-center text-sm text-gray-500 mt-4">
        ¿Ya tienes cuenta?
        <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
            Ingresar
        </a>
    </p>

</x-guest-layout>
