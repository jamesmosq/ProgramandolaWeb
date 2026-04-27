<section>
    <div class="mb-5">
        <h3 class="font-bold text-base text-white">Cambiar contraseña</h3>
        <p class="text-gray-500 text-xs mt-1">Usa una contraseña larga y aleatoria para mayor seguridad.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-400 mb-1.5">
                Contraseña actual
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                   autocomplete="current-password"
                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
            @error('current_password', 'updatePassword')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-400 mb-1.5">
                Nueva contraseña
            </label>
            <input id="update_password_password" name="password" type="password"
                   autocomplete="new-password"
                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
            @error('password', 'updatePassword')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-400 mb-1.5">
                Confirmar nueva contraseña
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   autocomplete="new-password"
                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
            @error('password_confirmation', 'updatePassword')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit"
                    class="px-5 py-2.5 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-xl text-sm transition-colors">
                Actualizar contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-emerald-400 mono">
                    Guardado
                </p>
            @endif
        </div>
    </form>
</section>
