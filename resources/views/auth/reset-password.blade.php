<x-guest-layout title="Nueva contraseña">

    <h1 class="text-xl font-bold mb-1">Nueva contraseña</h1>
    <p class="text-gray-500 text-sm mb-6">Elige una contraseña segura para tu cuenta.</p>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">
                Correo electrónico
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                   required autofocus autocomplete="username"
                   class="w-full bg-gray-800 border border-white/10 text-white placeholder-gray-600
                          rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500
                          transition-colors @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1.5 mono text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">
                Nueva contraseña
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

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1.5">
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

        <button type="submit"
                class="w-full py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-xl
                       transition-colors text-sm shadow-lg shadow-cyan-500/20">
            Restablecer contraseña →
        </button>
    </form>

</x-guest-layout>
