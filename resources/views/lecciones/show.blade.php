<x-app-layout>
    <x-slot name="title">{{ $leccion->titulo }}</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8 mono">
            <a href="{{ route('modulos.index') }}" class="hover:text-white transition-colors">Módulos</a>
            <span>/</span>
            <a href="{{ route('modulos.show', $modulo) }}" class="hover:text-white transition-colors">{{ $modulo->nombre }}</a>
            <span>/</span>
            <span class="text-gray-400 truncate">{{ $leccion->titulo }}</span>
        </div>

        {{-- Header lección --}}
        <div class="mb-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold mb-2">{{ $leccion->titulo }}</h1>
                    @if($leccion->descripcion)
                    <p class="text-gray-400 leading-relaxed">{{ $leccion->descripcion }}</p>
                    @endif
                </div>
                @if($completada)
                <span class="flex-shrink-0 flex items-center gap-1.5 mono text-xs text-emerald-400 bg-emerald-400/10 border border-emerald-400/20 px-3 py-1.5 rounded-xl">
                    ✓ Completada
                </span>
                @endif
            </div>
            @if($leccion->duracion_minutos)
            <p class="mono text-xs text-gray-600 mt-3 flex items-center gap-1"><x-icon name="clock" class="w-3.5 h-3.5" /> ~{{ $leccion->duracion_minutos }} minutos</p>
            @endif
        </div>

        {{-- Flash success --}}
        @if(session('success'))
        <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl px-5 py-4 text-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Pasos --}}
        @if($pasos->isNotEmpty())
        <div class="space-y-6 mb-10">
            @foreach($pasos as $paso)
            @php
                $tipoBadge = match($paso->tipo) {
                    'codigo'    => 'bg-violet-400/10 text-violet-400 border-violet-400/20',
                    'ejercicio' => 'bg-orange-400/10 text-orange-400 border-orange-400/20',
                    'tip'       => 'bg-cyan-400/10 text-cyan-400 border-cyan-400/20',
                    default     => 'bg-gray-700 text-gray-400 border-gray-600',
                };
                $tipoLabel = match($paso->tipo) {
                    'codigo'    => 'Código',
                    'ejercicio' => 'Ejercicio',
                    'tip'       => 'Tip',
                    default     => 'Teoría',
                };
            @endphp
            <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-3 border-b border-gray-800">
                    <span class="mono text-xs text-gray-600">{{ str_pad($paso->orden, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="font-semibold text-sm flex-1">{{ $paso->titulo }}</h3>
                    <span class="mono text-xs border {{ $tipoBadge }} px-2 py-0.5 rounded-lg">{{ $tipoLabel }}</span>
                </div>
                <div class="px-5 py-5 text-sm text-gray-300 leading-relaxed prose-custom">
                    {!! nl2br(e($paso->contenido)) !!}
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Ejercicios --}}
        @if($ejercicios->isNotEmpty())
        <div class="mb-10">
            <h2 class="font-bold text-lg mb-4">Ejercicios</h2>
            <div class="space-y-4">
                @foreach($ejercicios as $ejercicio)
                @php
                    $dif = match($ejercicio->dificultad) {
                        'medio'  => 'bg-yellow-400/10 text-yellow-400 border-yellow-400/20',
                        'dificil'=> 'bg-red-400/10 text-red-400 border-red-400/20',
                        default  => 'bg-emerald-400/10 text-emerald-400 border-emerald-400/20',
                    };
                @endphp
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <h4 class="font-semibold text-sm">{{ $ejercicio->enunciado }}</h4>
                        <span class="mono text-xs border {{ $dif }} px-2 py-0.5 rounded-lg flex-shrink-0">
                            {{ ucfirst($ejercicio->dificultad) }}
                        </span>
                    </div>
                    @if($ejercicio->descripcion)
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $ejercicio->descripcion }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Marcar como completada --}}
        @if(!$completada)
        <div class="bg-gray-900 border border-dashed border-gray-700 rounded-2xl p-6 text-center mb-8">
            <p class="text-gray-400 text-sm mb-4">¿Terminaste esta lección? Márcala como completada para registrar tu progreso.</p>
            <form method="POST" action="{{ route('lecciones.completar', [$modulo, $leccion]) }}">
                @csrf
                <button type="submit"
                        class="px-6 py-2.5 bg-emerald-500 hover:bg-emerald-400 text-white font-semibold rounded-xl transition-colors text-sm">
                    Marcar como completada ✓
                </button>
            </form>
        </div>
        @endif

        {{-- Navegación anterior / siguiente --}}
        <div class="flex items-center justify-between gap-4 pt-4 border-t border-white/5">
            @if($anterior)
            <a href="{{ route('lecciones.show', [$modulo, $anterior]) }}"
               class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                ← {{ $anterior->titulo }}
            </a>
            @else
            <a href="{{ route('modulos.show', $modulo) }}"
               class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                ← Volver al módulo
            </a>
            @endif

            @if($siguiente)
            <a href="{{ route('lecciones.show', [$modulo, $siguiente]) }}"
               class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                {{ $siguiente->titulo }} →
            </a>
            @else
            <a href="{{ route('modulos.show', $modulo) }}"
               class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                Ver módulo →
            </a>
            @endif
        </div>

    </div>
</x-app-layout>
