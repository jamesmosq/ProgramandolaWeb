<nav x-data="{ open: false }" class="border-b border-white/5 bg-gray-950/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-cyan-400 to-violet-500 flex items-center justify-center text-sm font-bold text-white shadow-lg">E</div>
                    <span class="font-bold text-base tracking-tight">{{ config('app.name', 'EduCode') }}</span>
                </a>

                {{-- Nav links (desktop) --}}
                <ul class="hidden sm:flex items-center gap-6 text-sm text-gray-400 list-none">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="hover:text-white transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('modulos.index') }}"
                           class="hover:text-white transition-colors {{ request()->routeIs('modulos.*') ? 'text-white' : '' }}">
                            Módulos
                        </a>
                    </li>
                </ul>
            </div>

            {{-- User menu (desktop) --}}
            <div class="hidden sm:flex items-center gap-3">
                <div x-data="{ show: false }" class="relative">
                    <button @click="show = !show"
                            class="flex items-center gap-2 px-3 py-1.5 text-sm text-gray-400 hover:text-white border border-white/10 hover:border-white/20 rounded-xl transition-colors">
                        <span class="w-6 h-6 rounded-lg bg-gradient-to-br from-cyan-400/30 to-violet-500/30 flex items-center justify-center text-xs font-bold text-cyan-400">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        {{ Auth::user()->name }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="show" @click.outside="show = false" x-transition
                         class="absolute right-0 mt-2 w-48 bg-gray-900 border border-white/10 rounded-2xl shadow-xl py-1 z-50">
                        <div class="px-4 py-2 border-b border-white/5 mb-1">
                            <p class="text-xs text-gray-500 mono truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">
                            Mi perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-400 hover:text-red-400 hover:bg-red-500/5 transition-colors">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Hamburger (mobile) --}}
            <button @click="open = !open" class="sm:hidden p-2 text-gray-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-white/5 bg-gray-950">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block py-2 text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }} hover:text-white transition-colors">
                Dashboard
            </a>
            <a href="{{ route('modulos.index') }}"
               class="block py-2 text-sm {{ request()->routeIs('modulos.*') ? 'text-white' : 'text-gray-400' }} hover:text-white transition-colors">
                Módulos
            </a>
        </div>
        <div class="px-4 py-3 border-t border-white/5">
            <p class="text-xs text-gray-500 mono mb-2">{{ Auth::user()->email }}</p>
            <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-gray-400 hover:text-white transition-colors">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="py-2 text-sm text-gray-500 hover:text-red-400 transition-colors">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>
