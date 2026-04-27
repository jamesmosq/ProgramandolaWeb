<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $codigo }} — {{ config('app.name', 'EduCode') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@600&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Sora', system-ui, sans-serif;
            background: #030712;
            color: #f9fafb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background-image:
                radial-gradient(ellipse 60% 40% at 20% 20%, rgba(6,182,212,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 50% 35% at 80% 80%, rgba(124,58,237,0.07) 0%, transparent 60%);
        }
        .mono { font-family: 'JetBrains Mono', monospace; }
        .logo {
            display: flex; align-items: center; gap: 0.6rem;
            text-decoration: none; margin-bottom: 3rem;
        }
        .logo-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, #22d3ee, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem; color: white;
        }
        .logo-text { font-weight: 700; font-size: 1rem; color: white; }
        .code {
            font-family: 'JetBrains Mono', monospace;
            font-size: clamp(5rem, 18vw, 9rem);
            font-weight: 700; line-height: 1;
            background: linear-gradient(135deg, #67e8f9 0%, #a78bfa 50%, #f472b6 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; margin-bottom: 1.5rem;
        }
        .title {
            font-size: clamp(1.25rem, 4vw, 1.75rem);
            font-weight: 700; margin-bottom: 0.75rem; text-align: center;
        }
        .desc {
            color: #9ca3af; font-size: 1rem; line-height: 1.6;
            max-width: 400px; text-align: center; margin-bottom: 2.5rem;
        }
        .actions { display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.7rem 1.5rem; background: #06b6d4;
            color: white; font-weight: 600; font-size: 0.9rem;
            border-radius: 12px; text-decoration: none; border: none; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #22d3ee; }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.7rem 1.5rem; background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #d1d5db; font-weight: 600; font-size: 0.9rem;
            border-radius: 12px; text-decoration: none; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); }
        .badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-family: 'JetBrains Mono', monospace; font-size: 0.7rem;
            color: #6b7280; margin-top: 3rem;
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="logo">
        <div class="logo-icon">E</div>
        <span class="logo-text">{{ config('app.name', 'EduCode') }}</span>
    </a>

    <div class="code">{{ $codigo }}</div>
    <h1 class="title">{{ $titulo }}</h1>
    <p class="desc">{{ $descripcion }}</p>

    <div class="actions">
        {{ $acciones }}
    </div>

    <span class="badge">{{ config('app.name') }} · error {{ $codigo }}</span>
</body>
</html>
