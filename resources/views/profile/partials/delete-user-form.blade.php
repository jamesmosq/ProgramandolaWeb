<section class="space-y-5">
    <div>
        <h3 class="font-bold text-base text-red-400">Eliminar cuenta</h3>
        <p class="text-gray-500 text-xs mt-1">
            Una vez eliminada, todos los datos se borrarán permanentemente. Esta acción no se puede deshacer.
        </p>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 font-semibold rounded-xl text-sm transition-colors">
        Eliminar mi cuenta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-bold text-white mb-1">¿Eliminar tu cuenta?</h2>
            <p class="text-gray-400 text-sm mb-5">
                Todos tus datos y progreso serán borrados permanentemente. Escribe tu contraseña para confirmar.
            </p>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-400 mb-1.5">Contraseña</label>
                <input id="password" name="password" type="password"
                       placeholder="Tu contraseña actual"
                       class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-colors
                              placeholder:text-gray-600">
                @error('password', 'userDeletion')
                    <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 font-semibold rounded-xl text-sm transition-colors">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-500 hover:bg-red-400 text-white font-semibold rounded-xl text-sm transition-colors">
                    Sí, eliminar cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
