<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">

        {{-- Greeting --}}
        <div class="mb-10">
            <p class="mono text-xs text-gray-500 mb-1">Bienvenido de vuelta 👋</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold">{{ Auth::user()->name }}</h1>
            <p class="text-gray-400 text-sm mt-1">
                @if($progreso['completadas'] > 0)
                    Llevas {{ $progreso['completadas'] }} lección{{ $progreso['completadas'] === 1 ? '' : 'es' }} completada{{ $progreso['completadas'] === 1 ? '' : 's' }}.
                    @if($progreso['completadas'] < $progreso['total'])
                        ¡Sigue así!
                    @else
                        ¡Completaste todo el curso! 🎉
                    @endif
                @else
                    Aún no has comenzado. ¡El primer módulo te espera!
                @endif
            </p>
        </div>

        {{-- Stats rápidos --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
            @foreach([
                ['Módulos', $progreso['modulos_total'], 'text-cyan-400', 'bg-cyan-400/10'],
                ['Completados', $progreso['modulos_completados'], 'text-emerald-400', 'bg-emerald-400/10'],
                ['Lecciones', $progreso['total'], 'text-violet-400', 'bg-violet-400/10'],
                ['Hechas', $progreso['completadas'], 'text-orange-400', 'bg-orange-400/10'],
            ] as [$label, $value, $text, $bg])
            <div class="rounded-2xl border border-white/5 bg-gray-900 p-5 text-center">
                <div class="mono text-2xl font-bold {{ $text }}">{{ $value }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        {{-- Barra de progreso global --}}
        @if($progreso['total'] > 0)
        <div class="mb-10 bg-gray-900 border border-white/5 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold">Progreso del curso</span>
                <span class="mono text-xs text-gray-400">{{ $progreso['porcentaje'] }}%</span>
            </div>
            <div class="h-2 bg-gray-800 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-cyan-500 to-violet-500 rounded-full transition-all duration-700"
                     style="width: {{ $progreso['porcentaje'] }}%"></div>
            </div>
        </div>
        @endif

        {{-- Módulos --}}
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-bold text-lg">Módulos del curso</h2>
            <a href="{{ route('modulos.index') }}" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors mono">
                Ver todos →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($modulos as $modulo)
            @php
                $colores = [
                    'cyan'    => ['badge' => 'bg-cyan-400/10 text-cyan-400 border-cyan-400/15',    'hover' => 'group-hover:text-cyan-400',    'bar' => 'from-cyan-500 to-cyan-400',    'border' => 'border-cyan-400/30',    'icon' => 'text-cyan-400'],
                    'violet'  => ['badge' => 'bg-violet-400/10 text-violet-400 border-violet-400/15',  'hover' => 'group-hover:text-violet-400',  'bar' => 'from-violet-500 to-violet-400',  'border' => 'border-violet-400/30',  'icon' => 'text-violet-400'],
                    'pink'    => ['badge' => 'bg-pink-400/10 text-pink-400 border-pink-400/15',    'hover' => 'group-hover:text-pink-400',    'bar' => 'from-pink-500 to-pink-400',    'border' => 'border-pink-400/30',    'icon' => 'text-pink-400'],
                    'orange'  => ['badge' => 'bg-orange-400/10 text-orange-400 border-orange-400/15',  'hover' => 'group-hover:text-orange-400',  'bar' => 'from-orange-500 to-orange-400',  'border' => 'border-orange-400/30',  'icon' => 'text-orange-400'],
                    'purple'  => ['badge' => 'bg-purple-400/10 text-purple-400 border-purple-400/15',  'hover' => 'group-hover:text-purple-400',  'bar' => 'from-purple-500 to-purple-400',  'border' => 'border-purple-400/30',  'icon' => 'text-purple-400'],
                    'emerald' => ['badge' => 'bg-emerald-400/10 text-emerald-400 border-emerald-400/15', 'hover' => 'group-hover:text-emerald-400', 'bar' => 'from-emerald-500 to-emerald-400', 'border' => 'border-emerald-400/30', 'icon' => 'text-emerald-400'],
                ];
                $c = $colores[$modulo->color] ?? $colores['cyan'];
                $pct = $modulo->lecciones_count > 0
                    ? round(($modulo->completadas_count / $modulo->lecciones_count) * 100)
                    : 0;
            @endphp
            <a href="{{ route('modulos.show', $modulo) }}"
               class="group block bg-gray-900 border border-gray-800 hover:{{ $c['border'] }} rounded-2xl p-6 transition-all duration-200 hover:-translate-y-1"
               style="box-shadow: 0 0 0 1px rgba(255,255,255,0.04), 0 4px 24px rgba(0,0,0,0.3);">

                <div class="flex items-start justify-between mb-5">
                    <x-icon :name="$modulo->icono" class="w-8 h-8 {{ $c['icon'] }}" />
                    <span class="mono text-xs {{ $c['badge'] }} border px-2.5 py-1 rounded-lg">
                        Módulo {{ str_pad($modulo->orden, 2, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <h3 class="font-bold text-base {{ $c['hover'] }} transition-colors mb-1.5">
                    {{ $modulo->nombre }}
                </h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-4 line-clamp-2">{{ $modulo->descripcion }}</p>

                {{-- Progreso --}}
                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="mono text-xs text-gray-600">{{ $modulo->completadas_count }}/{{ $modulo->lecciones_count }} lecciones</span>
                        <span class="mono text-xs text-gray-500">{{ $pct }}%</span>
                    </div>
                    <div class="h-1.5 bg-gray-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r {{ $c['bar'] }} rounded-full transition-all duration-500"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-600">{{ $modulo->lecciones_count }} lecciones</span>
                    @if($pct === 100)
                        <span class="mono text-xs text-emerald-400">✓ Completado</span>
                    @elseif($pct > 0)
                        <span class="mono text-xs text-cyan-400">En progreso</span>
                    @else
                        <span class="mono text-xs text-gray-600">Sin comenzar</span>
                    @endif
                </div>
            </a>
            @endforeach

            {{-- Placeholder si no hay módulos --}}
            @if($modulos->isEmpty())
            <div class="col-span-full text-center py-16 text-gray-600">
                <x-icon name="wrench" class="w-10 h-10 text-gray-700 mx-auto mb-4" />
                <p class="font-semibold text-gray-400">Módulos en preparación</p>
                <p class="text-sm mt-1">El contenido estará disponible pronto.</p>
            </div>
            @endif
        </div>

    </div>
</x-app-layout>
