<x-app-layout>
    <x-slot name="title">Mi perfil</x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">Mi perfil</h2>
        <p class="text-sm text-gray-400 mt-0.5">Actualiza tu información personal y contraseña.</p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-10 space-y-6">

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-gray-900 border border-red-900/30 rounded-2xl p-6">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</x-app-layout>
