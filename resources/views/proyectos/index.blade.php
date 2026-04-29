<x-app-layout>
    <x-slot name="title">Proyectos Propuestos</x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-icon name="bolt" class="w-6 h-6 text-orange-400" />
            <div>
                <h2 class="text-xl font-bold text-white">Proyectos Propuestos</h2>
                <p class="text-sm text-gray-400 mt-0.5">Un proyecto guiado paso a paso y cuatro ideas para desarrollar por tu cuenta.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 space-y-5">

        {{-- Proyecto guiado --}}
        <a href="{{ route('proyectos.show', 'guia_proyecto_sena') }}"
           class="group flex items-start gap-5 bg-gray-900 border border-gray-800 hover:border-orange-400/40 rounded-2xl p-6 transition-all duration-200 hover:-translate-y-0.5">

            <div class="w-12 h-12 rounded-2xl bg-orange-400/10 border border-orange-400/20 flex items-center justify-center flex-shrink-0">
                <x-icon name="list" class="w-6 h-6 text-orange-400" />
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <span class="mono text-xs bg-orange-400/10 text-orange-400 border border-orange-400/20 px-2 py-0.5 rounded-lg">Guiado · Paso a paso</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-orange-400 transition-colors">Sistema Académico</h3>
                <p class="text-gray-500 text-sm mt-1 leading-relaxed">
                    Construye un sistema académico completo con Laravel 13 + Moonshine 4.x. 12 pasos: desde instalación hasta deploy en Railway, con 6 tablas, relaciones reales, 4 roles y policies.
                </p>
                <div class="flex items-center gap-4 mt-3 text-xs text-gray-600 mono">
                    <span>12 pasos</span>
                    <span>Laravel 13</span>
                    <span>Moonshine 4.x</span>
                    <span>Deploy Railway</span>
                </div>
            </div>

            <div class="text-gray-600 group-hover:text-orange-400 transition-colors text-lg self-center">→</div>
        </a>

        {{-- Divisor --}}
        <div class="flex items-center gap-4 py-2">
            <div class="flex-1 h-px bg-white/5"></div>
            <span class="mono text-xs text-gray-600">Proyectos independientes</span>
            <div class="flex-1 h-px bg-white/5"></div>
        </div>

        {{-- Proyectos propuestos --}}
        <a href="{{ route('proyectos.show', 'proyectos_propuestos') }}"
           class="group flex items-start gap-5 bg-gray-900 border border-gray-800 hover:border-violet-400/40 rounded-2xl p-6 transition-all duration-200 hover:-translate-y-0.5">

            <div class="w-12 h-12 rounded-2xl bg-violet-400/10 border border-violet-400/20 flex items-center justify-center flex-shrink-0">
                <x-icon name="code" class="w-6 h-6 text-violet-400" />
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <span class="mono text-xs bg-violet-400/10 text-violet-400 border border-violet-400/20 px-2 py-0.5 rounded-lg">4 proyectos · Elige uno</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-violet-400 transition-colors">Ideas de Proyecto</h3>
                <p class="text-gray-500 text-sm mt-1 leading-relaxed">
                    Cuatro propuestas para aplicar lo aprendido de forma independiente: Inventario PYME, Clínica Veterinaria, Gestión de Software y Biblioteca Digital. Cada una incluye tablas, relaciones, roles y un reto adicional.
                </p>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3 text-xs text-gray-600 mono">
                    <span>Inventario PYME</span>
                    <span>·</span>
                    <span>Clínica Veterinaria</span>
                    <span>·</span>
                    <span>Gestión de Software</span>
                    <span>·</span>
                    <span>Biblioteca Digital</span>
                </div>
            </div>

            <div class="text-gray-600 group-hover:text-violet-400 transition-colors text-lg self-center">→</div>
        </a>

    </div>
</x-app-layout>
