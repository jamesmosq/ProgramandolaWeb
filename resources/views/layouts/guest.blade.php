<!DOCTYPE html>
<html lang="es" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' — ' : '' }}{{ config('app.name', 'EduCode') }}</title>

        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Sora:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Sora', sans-serif; }
            .mono { font-family: 'JetBrains Mono', monospace; }
        </style>
    </head>
    <body class="bg-gray-950 text-gray-100 antialiased min-h-screen">

        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-4"
             style="background: radial-gradient(ellipse 70% 50% at 20% 10%, rgba(6,182,212,0.06) 0%, transparent 60%), radial-gradient(ellipse 60% 40% at 80% 80%, rgba(124,58,237,0.06) 0%, transparent 60%);">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2.5 mb-5">
                <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-cyan-400 to-violet-500 flex items-center justify-center text-sm font-bold text-white shadow-lg">
                    E
                </div>
                <span class="font-bold text-base tracking-tight">{{ config('app.name', 'EduCode') }}</span>
            </a>

            {{-- Card --}}
            <div class="w-full max-w-md bg-gray-900 border border-white/8 rounded-3xl shadow-2xl px-7 py-6"
                 style="box-shadow: 0 0 0 1px rgba(255,255,255,0.05), 0 24px 48px rgba(0,0,0,0.5);">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <p class="mono text-xs text-gray-700 mt-4">
                {{ config('app.name') }}
            </p>
        </div>

    </body>
</html>
