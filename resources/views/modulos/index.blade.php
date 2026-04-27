<x-app-layout>
    <x-slot name="title">Módulos</x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">Módulos del curso</h2>
        <p class="text-sm text-gray-400 mt-0.5">5 módulos en secuencia — de bases de datos a panel admin.</p>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($modulos as $modulo)
            @php
                $colores = [
                    'cyan'   => ['hover' => 'group-hover:text-cyan-400',   'bar' => 'from-cyan-500 to-cyan-400',   'border' => 'hover:border-cyan-400/30',  'badge' => 'bg-cyan-400/10 text-cyan-400 border-cyan-400/15'],
                    'violet' => ['hover' => 'group-hover:text-violet-400', 'bar' => 'from-violet-500 to-violet-400', 'border' => 'hover:border-violet-400/30','badge' => 'bg-violet-400/10 text-violet-400 border-violet-400/15'],
                    'pink'   => ['hover' => 'group-hover:text-pink-400',   'bar' => 'from-pink-500 to-pink-400',   'border' => 'hover:border-pink-400/30',  'badge' => 'bg-pink-400/10 text-pink-400 border-pink-400/15'],
                    'orange' => ['hover' => 'group-hover:text-orange-400', 'bar' => 'from-orange-500 to-orange-400', 'border' => 'hover:border-orange-400/30','badge' => 'bg-orange-400/10 text-orange-400 border-orange-400/15'],
                    'purple' => ['hover' => 'group-hover:text-purple-400', 'bar' => 'from-purple-500 to-purple-400', 'border' => 'hover:border-purple-400/30','badge' => 'bg-purple-400/10 text-purple-400 border-purple-400/15'],
                ];
                $c = $colores[$modulo->color] ?? $colores['cyan'];
                $pct = $modulo->lecciones_count > 0
                    ? round(($modulo->completadas_count / $modulo->lecciones_count) * 100)
                    : 0;
            @endphp
            <a href="{{ route('modulos.show', $modulo) }}"
               class="group block bg-gray-900 border border-gray-800 {{ $c['border'] }} rounded-2xl p-6 transition-all duration-200 hover:-translate-y-1"
               style="box-shadow: 0 0 0 1px rgba(255,255,255,0.04), 0 4px 24px rgba(0,0,0,0.3);">

                <div class="flex items-start justify-between mb-5">
                    <span class="text-3xl">{{ $modulo->icono }}</span>
                    <span class="mono text-xs {{ $c['badge'] }} border px-2.5 py-1 rounded-lg">
                        Módulo {{ str_pad($modulo->orden, 2, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <h3 class="font-bold text-base {{ $c['hover'] }} transition-colors mb-1.5">{{ $modulo->nombre }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-5 line-clamp-2">{{ $modulo->descripcion }}</p>

                <div class="mb-1.5 flex items-center justify-between">
                    <span class="mono text-xs text-gray-600">{{ $modulo->completadas_count }}/{{ $modulo->lecciones_count }} lecciones</span>
                    <span class="mono text-xs text-gray-500">{{ $pct }}%</span>
                </div>
                <div class="h-1.5 bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r {{ $c['bar'] }} rounded-full transition-all"
                         style="width: {{ $pct }}%"></div>
                </div>

                <div class="mt-4 flex items-center justify-between text-xs">
                    <span class="text-gray-600">{{ $modulo->lecciones_count }} lecciones</span>
                    @if($pct === 100)
                        <span class="mono text-emerald-400">✓ Completado</span>
                    @elseif($pct > 0)
                        <span class="mono text-cyan-400">En progreso →</span>
                    @else
                        <span class="mono text-gray-600">Comenzar →</span>
                    @endif
                </div>
            </a>
            @endforeach

            @if($modulos->isEmpty())
            <div class="col-span-full text-center py-20 text-gray-600">
                <p class="text-4xl mb-4">📦</p>
                <p class="font-semibold text-gray-400">Sin módulos todavía</p>
                <p class="text-sm mt-1">El contenido estará disponible pronto.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
