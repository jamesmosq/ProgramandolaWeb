<x-app-layout>
    <x-slot name="title">Panel admin</x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-icon name="viewfinder" class="w-6 h-6 text-violet-400" />
            <div>
                <h2 class="text-xl font-bold text-white">Panel de administración</h2>
                <p class="text-sm text-gray-400 mt-0.5">Vista global de la plataforma y gestión de usuarios.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10 space-y-8">

        {{-- Flash --}}
        @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl px-5 py-3 text-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats globales --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach([
                ['Estudiantes',   $stats['estudiantes'],     'text-cyan-400',    'bg-cyan-400/10',    'user'],
                ['Completaciones', $stats['completaciones'],  'text-emerald-400', 'bg-emerald-400/10', 'check'],
                ['Lecciones totales', $stats['total_lecciones'], 'text-violet-400', 'bg-violet-400/10', 'list'],
                ['Promedio global', $stats['promedio_pct'].'%', 'text-orange-400', 'bg-orange-400/10', 'arrow-path'],
            ] as [$label, $value, $text, $bg, $icon])
            <div class="rounded-2xl border border-white/5 bg-gray-900 p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="{{ $bg }} rounded-lg p-1.5">
                        <x-icon :name="$icon" class="w-4 h-4 {{ $text }}" />
                    </span>
                    <span class="text-xs text-gray-500">{{ $label }}</span>
                </div>
                <div class="mono text-2xl font-bold {{ $text }}">{{ $value }}</div>
            </div>
            @endforeach
        </div>

        {{-- Tabla de usuarios --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-800 flex items-center justify-between">
                <h3 class="font-bold text-base">Usuarios registrados</h3>
                <span class="mono text-xs text-gray-500">{{ $stats['estudiantes'] }} total</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 mono">Usuario</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 mono hidden sm:table-cell">Correo</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 mono">Progreso</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 mono hidden md:table-cell">Registro</th>
                            <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 mono">Rol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($usuarios as $u)
                        <tr class="hover:bg-white/[0.02] transition-colors">

                            {{-- Nombre --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-cyan-400/20 to-violet-500/20 flex items-center justify-center text-xs font-bold text-cyan-400 flex-shrink-0">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </span>
                                    <div>
                                        <p class="font-semibold text-white leading-tight">{{ $u->name }}</p>
                                        <p class="text-xs text-gray-500 sm:hidden">{{ $u->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="mono text-xs text-gray-400">{{ $u->email }}</span>
                            </td>

                            {{-- Progreso --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-20 h-1.5 bg-gray-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-cyan-500 to-violet-500 rounded-full"
                                             style="width: {{ $u->pct }}%"></div>
                                    </div>
                                    <span class="mono text-xs text-gray-500 whitespace-nowrap">
                                        {{ $u->completadas }}/{{ $stats['total_lecciones'] }}
                                        <span class="text-gray-600">({{ $u->pct }}%)</span>
                                    </span>
                                </div>
                            </td>

                            {{-- Fecha registro --}}
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="mono text-xs text-gray-600">{{ $u->created_at->format('d/m/Y') }}</span>
                            </td>

                            {{-- Rol + toggle --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($u->is_admin)
                                        <span class="mono text-xs bg-violet-400/10 text-violet-400 border border-violet-400/20 px-2 py-0.5 rounded-lg">Admin</span>
                                    @endif
                                    @if($u->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.toggle', $u) }}">
                                        @csrf
                                        <button type="submit"
                                                class="mono text-xs px-2.5 py-1 rounded-lg border transition-colors
                                                    {{ $u->is_admin
                                                        ? 'border-red-500/30 text-red-400 hover:bg-red-500/10'
                                                        : 'border-gray-700 text-gray-500 hover:text-violet-400 hover:border-violet-400/30' }}">
                                            {{ $u->is_admin ? 'Quitar admin' : 'Hacer admin' }}
                                        </button>
                                    </form>
                                    @else
                                        <span class="mono text-xs text-gray-600">Tú</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
