<section>
    <div class="mb-5">
        <h3 class="font-bold text-base text-white">Información del perfil</h3>
        <p class="text-gray-500 text-xs mt-1">Actualiza tu nombre y dirección de correo electrónico.</p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-400 mb-1.5">Nombre</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name"
                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors
                          placeholder:text-gray-600">
            @error('name')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-400 mb-1.5">Correo electrónico</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username"
                   class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 transition-colors
                          placeholder:text-gray-600">
            @error('email')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-yellow-400/10 border border-yellow-400/20 rounded-xl">
                    <p class="text-yellow-400 text-xs">
                        Tu correo no está verificado.
                        <button form="send-verification"
                                class="underline hover:text-yellow-300 transition-colors">
                            Reenviar verificación
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs text-emerald-400">Enlace de verificación enviado.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-1">
            <button type="submit"
                    class="px-5 py-2.5 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-xl text-sm transition-colors">
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
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
