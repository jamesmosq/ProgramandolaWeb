<x-app-layout>
    <x-slot name="title">{{ $modulo->nombre }}</x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route('modulos.index') }}" class="text-gray-500 hover:text-white transition-colors text-sm">← Módulos</a>
        </div>
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-3xl">{{ $modulo->icono }}</span>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $modulo->nombre }}</h2>
                    <p class="text-sm text-gray-400 mt-0.5">{{ $modulo->descripcion }}</p>
                </div>
            </div>
            @php
                $talleres = [1=>'taller_01_bases_de_datos',2=>'taller_02_php_puro',3=>'taller_03_html_css',4=>'taller_04_laravel',5=>'taller_05_moonshine'];
                $guias    = [1=>'guia_sql_mysql',2=>'guia_php',3=>null,4=>'guia_laravel',5=>'guia_moonshine'];
                $taller   = $talleres[$modulo->orden] ?? null;
                $guia     = $guias[$modulo->orden] ?? null;
            @endphp
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($taller)
                <a href="/talleres/{{ $taller }}.html" target="_blank"
                   class="flex items-center gap-1.5 mono text-xs px-3 py-1.5 bg-cyan-400/10 text-cyan-400 border border-cyan-400/20 rounded-xl hover:bg-cyan-400/20 transition-colors">
                    📋 Taller
                </a>
                @endif
                @if($guia)
                <a href="/guias/{{ $guia }}.html" target="_blank"
                   class="flex items-center gap-1.5 mono text-xs px-3 py-1.5 bg-violet-400/10 text-violet-400 border border-violet-400/20 rounded-xl hover:bg-violet-400/20 transition-colors">
                    📖 Guía
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">

        {{-- Progreso del módulo --}}
        @if($lecciones->count() > 0)
        <div class="bg-gray-900 border border-white/5 rounded-2xl p-5 mb-8">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold">Tu progreso en este módulo</span>
                <span class="mono text-xs text-gray-400">{{ $completadas }}/{{ $lecciones->count() }} completadas</span>
            </div>
            <div class="h-2 bg-gray-800 rounded-full overflow-hidden">
                @php $pct = $lecciones->count() > 0 ? round(($completadas / $lecciones->count()) * 100) : 0; @endphp
                <div class="h-full bg-gradient-to-r from-cyan-500 to-violet-500 rounded-full transition-all"
                     style="width: {{ $pct }}%"></div>
            </div>
        </div>
        @endif

        {{-- Lista de lecciones --}}
        <div class="space-y-3">
            @foreach($lecciones as $i => $leccion)
            <a href="{{ route('lecciones.show', [$modulo, $leccion]) }}"
               class="group flex items-start gap-4 bg-gray-900 border border-gray-800 hover:border-gray-700 rounded-2xl p-5 transition-all hover:-translate-y-0.5">

                {{-- Número / Check --}}
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 mono text-sm font-bold
                    {{ $leccion->completada ? 'bg-emerald-500/15 border border-emerald-500/30 text-emerald-400' : 'bg-gray-800 border border-gray-700 text-gray-500 group-hover:text-white group-hover:border-gray-600' }}">
                    {{ $leccion->completada ? '✓' : str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                </div>

                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold group-hover:text-white transition-colors {{ $leccion->completada ? 'text-gray-300' : 'text-white' }}">
                        {{ $leccion->titulo }}
                    </h3>
                    @if($leccion->descripcion)
                    <p class="text-gray-500 text-xs mt-0.5 line-clamp-1">{{ $leccion->descripcion }}</p>
                    @endif
                    <div class="flex items-center gap-4 mt-2 text-xs text-gray-600 mono">
                        @if($leccion->pasos_count > 0)
                        <span>{{ $leccion->pasos_count }} pasos</span>
                        @endif
                        @if($leccion->ejercicios_count > 0)
                        <span>{{ $leccion->ejercicios_count }} ejercicios</span>
                        @endif
                        @if($leccion->duracion_minutos)
                        <span>~{{ $leccion->duracion_minutos }} min</span>
                        @endif
                    </div>
                </div>

                <div class="text-gray-600 group-hover:text-gray-400 transition-colors text-lg self-center">→</div>
            </a>
            @endforeach

            @if($lecciones->isEmpty())
            <div class="text-center py-16 text-gray-600">
                <p class="text-3xl mb-3">📝</p>
                <p class="font-semibold text-gray-400">Lecciones en preparación</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
