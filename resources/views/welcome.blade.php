<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduCode') }} — Aprende programación paso a paso</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Sora:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Sora', sans-serif; }
        .mono { font-family: 'JetBrains Mono', monospace; }
        .glow-cyan  { text-shadow: 0 0 40px rgba(6,182,212,0.4); }
        .glow-card  { box-shadow: 0 0 0 1px rgba(255,255,255,0.06), 0 4px 24px rgba(0,0,0,0.4); }
        .gradient-text {
            background: linear-gradient(135deg, #67e8f9 0%, #a78bfa 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-bg {
            background:
                radial-gradient(ellipse 70% 50% at 20% 10%, rgba(6,182,212,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 80%, rgba(124,58,237,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 50% 30% at 60% 30%, rgba(244,114,182,0.05) 0%, transparent 50%);
        }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); }
        .step-line::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            bottom: -20px;
            width: 2px;
            background: linear-gradient(to bottom, rgba(6,182,212,0.3), transparent);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen antialiased">

{{-- ═══════════════ NAVBAR ═══════════════ --}}
<header class="fixed top-0 inset-x-0 z-50 border-b border-white/5 bg-gray-950/80 backdrop-blur-md">
    <nav class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-cyan-400 to-violet-500 flex items-center justify-center text-sm font-bold text-white shadow-lg">
                E
            </div>
            <span class="font-bold text-base tracking-tight">{{ config('app.name', 'EduCode') }}</span>
        </a>

        {{-- Links centro (tablet+) --}}
        <ul class="hidden md:flex items-center gap-7 text-sm text-gray-400 list-none">
            <li><a href="#modulos" class="hover:text-white transition-colors">Módulos</a></li>
            <li><a href="#ruta" class="hover:text-white transition-colors">Ruta de aprendizaje</a></li>
            <li><a href="#sobre" class="hover:text-white transition-colors">Sobre el curso</a></li>
        </ul>

        {{-- CTA --}}
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-white text-sm font-semibold rounded-xl transition-colors">
                    Mi dashboard →
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-400 hover:text-white transition-colors hidden sm:block">
                    Ingresar
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-white text-sm font-semibold rounded-xl transition-colors">
                    Empezar gratis
                </a>
            @endauth
        </div>
    </nav>
</header>

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="hero-bg pt-32 pb-24 px-4 sm:px-6 text-center relative overflow-hidden">

    {{-- Badge --}}
    <div class="inline-flex items-center gap-2 mono text-xs text-cyan-400 bg-cyan-400/10 border border-cyan-400/20 px-4 py-1.5 rounded-full mb-8">
        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
        Formación técnica en programación
    </div>

    {{-- Headline --}}
    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight max-w-4xl mx-auto mb-6">
        Aprende a programar<br>
        <span class="gradient-text glow-cyan">de cero a profesional</span>
    </h1>

    <p class="text-gray-400 text-lg sm:text-xl max-w-2xl mx-auto leading-relaxed mb-10">
        Desde SQL y PHP hasta Laravel y paneles admin. Cada lección es práctica, cada paso tiene código real.
        <strong class="text-gray-200">Tú marcas el ritmo.</strong>
    </p>

    {{-- CTA buttons --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        @auth
            <a href="{{ url('/dashboard') }}"
               class="px-8 py-3.5 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-2xl transition-colors text-base shadow-lg shadow-cyan-500/20">
                Continuar aprendiendo →
            </a>
        @else
            <a href="{{ route('register') }}"
               class="px-8 py-3.5 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-2xl transition-colors text-base shadow-lg shadow-cyan-500/20">
                Crear cuenta gratis →
            </a>
            <a href="{{ route('login') }}"
               class="px-8 py-3.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold rounded-2xl transition-colors text-base">
                Ya tengo cuenta
            </a>
        @endauth
    </div>

    {{-- Stats --}}
    <div class="flex flex-wrap items-center justify-center gap-8 mt-14">
        @foreach([
            ['6', 'Módulos'],
            ['30+', 'Lecciones'],
            ['100+', 'Ejercicios'],
            ['0', 'Costo'],
        ] as [$num, $label])
        <div class="text-center">
            <div class="mono text-2xl font-bold text-cyan-400">{{ $num }}</div>
            <div class="text-xs text-gray-500 mt-0.5">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- QR proyectable: mostrar en PC/TV para que los estudiantes escaneen con el celular --}}
    <div class="flex justify-center mt-10">
        <div class="relative">
            <div class="absolute -inset-px bg-gradient-to-r from-cyan-500/25 to-violet-500/25 rounded-2xl blur"></div>
            <div class="relative flex flex-col sm:flex-row items-center gap-6 bg-gray-900 border border-white/10 rounded-2xl px-7 py-6">
                {{-- QR --}}
                <div class="bg-white p-3 rounded-xl shadow-2xl flex-shrink-0">
                    <div id="qr-code"></div>
                </div>
                {{-- Texto --}}
                <div class="text-center sm:text-left">
                    <p class="font-bold text-base text-white mb-2 flex items-center gap-1.5"><x-icon name="mobile" class="w-4 h-4" /> Escanea para acceder</p>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-[220px]">
                        Apunta la cámara de tu celular al código y abre la plataforma sin escribir nada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ MÓDULOS ═══════════════ --}}
<section id="modulos" class="py-24 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-14">
            <span class="mono text-xs text-violet-400 tracking-widest uppercase">Contenido del curso</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold mt-3">6 módulos, una ruta clara</h2>
            <p class="text-gray-400 mt-3 max-w-xl mx-auto">Cada módulo construye sobre el anterior. Al terminar tendrás una plataforma web real funcionando.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- Módulo 1: Bases de Datos --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="database" class="w-8 h-8 text-cyan-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 01</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-cyan-400 transition-colors mb-2">Bases de Datos</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">SQL desde cero, MySQL, diseño de tablas, relaciones, claves foráneas y CASCADE.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['SQL', 'CREATE TABLE', 'JOIN', 'CASCADE'] as $tag)
                    <span class="mono text-xs bg-cyan-400/10 text-cyan-400 border border-cyan-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Módulo 2: PHP --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="code" class="w-8 h-8 text-violet-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 02</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-violet-400 transition-colors mb-2">PHP Puro</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Variables, funciones, arrays, POO con clases y herencia. Conecta PHP con MySQL usando PDO.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['PHP 8.3', 'OOP', 'PDO', 'Funciones'] as $tag)
                    <span class="mono text-xs bg-violet-400/10 text-violet-400 border border-violet-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Módulo 3: HTML/CSS --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="design" class="w-8 h-8 text-pink-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 03</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-pink-400 transition-colors mb-2">HTML & CSS</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Semántica HTML5, Tailwind CSS, Flexbox, Grid y diseño responsive mobile-first.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['HTML5', 'Tailwind', 'Flexbox', 'Grid'] as $tag)
                    <span class="mono text-xs bg-pink-400/10 text-pink-400 border border-pink-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Módulo 4: Laravel --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="bolt" class="w-8 h-8 text-orange-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 04</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-orange-400 transition-colors mb-2">Laravel 11</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">MVC, rutas, modelos Eloquent, vistas Blade, autenticación con Breeze y deploy en Railway.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['MVC', 'Eloquent', 'Blade', 'Breeze'] as $tag)
                    <span class="mono text-xs bg-orange-400/10 text-orange-400 border border-orange-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Módulo 5: Moonshine --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="moon" class="w-8 h-8 text-purple-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 05</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-purple-400 transition-colors mb-2">Laravel Moonshine</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Panel de administración: Resources, Fields, Actions y relaciones para gestionar contenido.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Moonshine v3', 'Resources', 'Admin panel', 'CRUD'] as $tag)
                    <span class="mono text-xs bg-purple-400/10 text-purple-400 border border-purple-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Módulo 6: Diseño Móvil --}}
            <div class="glow-card card-hover bg-gray-900 border border-gray-800 rounded-2xl p-6 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <x-icon name="mobile" class="w-8 h-8 text-emerald-400" />
                    <span class="mono text-xs text-gray-600 bg-gray-800 px-2.5 py-1 rounded-lg">Módulo 06</span>
                </div>
                <h3 class="font-bold text-lg group-hover:text-emerald-400 transition-colors mb-2">Diseño Móvil</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">Apps nativas para Android, iOS, Web y Desktop con Flutter (Dart) y Flet (Python).</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Flutter', 'Dart', 'Flet', 'Python'] as $tag)
                    <span class="mono text-xs bg-emerald-400/10 text-emerald-400 border border-emerald-400/15 px-2 py-0.5 rounded-md">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════ RUTA PASO A PASO ═══════════════ --}}
<section id="ruta" class="py-24 px-4 sm:px-6 bg-gray-900/40">
    <div class="max-w-3xl mx-auto">

        <div class="text-center mb-14">
            <span class="mono text-xs text-cyan-400 tracking-widest uppercase">Cómo funciona</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold mt-3">Tu ruta de aprendizaje</h2>
            <p class="text-gray-400 mt-3">Sigue los pasos en orden. Cada uno te prepara para el siguiente.</p>
        </div>

        <div class="space-y-4">
            @foreach([
                ['database', 'Aprende SQL y crea la base de datos', 'Diseñas las tablas reales de la plataforma. Entiendes relaciones, claves foráneas y por qué importa el orden.', 'cyan'],
                ['code',     'Domina PHP antes de Laravel', 'Variables, arrays, POO y PDO. Con esto entenderás el framework en lugar de solo copiar código.', 'violet'],
                ['design',   'Diseña interfaces con HTML y Tailwind', 'Construyes la UI de la plataforma desde cero. Responsive, dark mode y componentes reutilizables.', 'pink'],
                ['bolt',     'Construye el LMS con Laravel', 'Conectas todo: migraciones, modelos, controladores, vistas Blade y autenticación real con Breeze.', 'orange'],
                ['moon',     'Agrega el panel de administración', 'Moonshine convierte tu app en un producto completo con CRUD, búsquedas y gestión de contenido.', 'purple'],
                ['mobile',   'Crea apps móviles con Flutter y Flet', 'Un solo código para Android, iOS, Web y Desktop. Dart con Flutter o Python puro con Flet.', 'emerald'],
            ] as $i => [$icon, $titulo, $desc, $color])
            <div class="flex gap-5 relative {{ $i < 5 ? 'step-line' : '' }}">
                {{-- Número --}}
                <div @class([
                    'w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 font-bold mono text-sm border-2 relative z-10',
                    'bg-cyan-400/10 border-cyan-400/40 text-cyan-400' => $color === 'cyan',
                    'bg-violet-400/10 border-violet-400/40 text-violet-400' => $color === 'violet',
                    'bg-pink-400/10 border-pink-400/40 text-pink-400' => $color === 'pink',
                    'bg-orange-400/10 border-orange-400/40 text-orange-400' => $color === 'orange',
                    'bg-purple-400/10 border-purple-400/40 text-purple-400' => $color === 'purple',
                    'bg-emerald-400/10 border-emerald-400/40 text-emerald-400' => $color === 'emerald',
                ])>
                    0{{ $i + 1 }}
                </div>
                {{-- Contenido --}}
                <div class="pb-8 flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <x-icon :name="$icon" class="w-5 h-5" />
                        <h3 class="font-bold">{{ $titulo }}</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════ SOBRE EL CURSO ═══════════════ --}}
<section id="sobre" class="py-24 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <span class="mono text-xs text-violet-400 tracking-widest uppercase">¿Para quién es?</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold mt-3 mb-5">Diseñado para aprender desde cero</h2>
                <p class="text-gray-400 leading-relaxed mb-6">
                    No necesitas experiencia previa. Empezamos desde cero con bases de datos y llegamos hasta
                    construir una aplicación web completa con panel de administración.
                </p>
                <ul class="space-y-3">
                    @foreach([
                        'Explicaciones en español colombiano',
                        'Código real, no ejercicios artificiales',
                        'Construyes la plataforma que estás usando',
                        'Deploy en producción con Railway',
                        'Acceso permanente al contenido',
                    ] as $item)
                    <li class="flex items-center gap-3 text-sm text-gray-300">
                        <span class="w-5 h-5 rounded-full bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center flex-shrink-0 text-emerald-400"><x-icon name="check" class="w-3 h-3" /></span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Feature cards --}}
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['bolt',       'Aprendizaje activo', 'Cada paso tiene un ejercicio para practicar, no solo leer.'],
                    ['viewfinder', 'Objetivo claro', 'Al final tienes un proyecto real en tu portafolio.'],
                    ['arrow-path', 'Progreso visible', 'Marca lecciones completadas y ve tu avance en tiempo real.'],
                    ['wrench',     'Stack moderno', 'PHP 8.3, Laravel 11, Tailwind CSS y MySQL.'],
                ] as [$icon, $title, $desc])
                <div class="glow-card bg-gray-900 border border-gray-800 rounded-2xl p-5">
                    <x-icon :name="$icon" class="w-6 h-6 mb-3 text-gray-400" />
                    <h4 class="font-bold text-sm mb-1">{{ $title }}</h4>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ CTA FINAL ═══════════════ --}}
<section class="py-24 px-4 sm:px-6">
    <div class="max-w-2xl mx-auto text-center">
        <div class="glow-card bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 border border-white/8 rounded-3xl p-10 sm:p-14">
            <x-icon name="rocket" class="w-12 h-12 mx-auto mb-6 text-cyan-400" />
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">¿Listo para empezar?</h2>
            <p class="text-gray-400 mb-8 leading-relaxed">
                Crea tu cuenta, elige el primer módulo y comienza a escribir tu primer <code class="mono text-cyan-400 bg-cyan-400/10 px-1.5 py-0.5 rounded">CREATE TABLE</code> hoy.
            </p>
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="inline-block px-10 py-4 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-2xl transition-colors text-lg shadow-xl shadow-cyan-500/20">
                    Ir a mi dashboard →
                </a>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                       class="px-10 py-4 bg-cyan-500 hover:bg-cyan-400 text-white font-bold rounded-2xl transition-colors text-lg shadow-xl shadow-cyan-500/20">
                        Crear cuenta gratis →
                    </a>
                    <a href="{{ route('login') }}"
                       class="px-10 py-4 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold rounded-2xl transition-colors text-lg">
                        Ingresar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</section>

{{-- ═══════════════ FOOTER ═══════════════ --}}
<footer class="border-t border-white/5 py-10 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto flex items-center justify-center gap-2.5">
        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-cyan-400 to-violet-500 flex items-center justify-center text-xs font-bold text-white">E</div>
        <span class="font-bold text-sm">{{ config('app.name', 'EduCode') }}</span>
        <span class="mono text-xs text-gray-600">{{ now()->year }}</span>
    </div>
</footer>

<script src="/js/qrcode.min.js"></script>
<script>
    new QRCode(document.getElementById('qr-code'), {
        text: 'https://programandolaweb-production.up.railway.app/',
        width: 160,
        height: 160,
        colorDark: '#000000',
        colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.M
    });
</script>
</body>
</html>
