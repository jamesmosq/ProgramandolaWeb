<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mantenimiento — EduCode</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@600&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Sora', system-ui, sans-serif; background: #030712; color: #f9fafb; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem 1rem; background-image: radial-gradient(ellipse 60% 40% at 50% 30%, rgba(251,191,36,0.06) 0%, transparent 60%); }
        .logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; margin-bottom: 3rem; }
        .logo-icon { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #22d3ee, #8b5cf6); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; color: white; }
        .logo-text { font-weight: 700; font-size: 1rem; color: white; }
        .icon { font-size: 5rem; margin-bottom: 1.5rem; }
        .title { font-size: clamp(1.5rem, 4vw, 2rem); font-weight: 800; margin-bottom: 0.75rem; text-align: center; }
        .desc { color: #9ca3af; font-size: 1rem; line-height: 1.6; max-width: 420px; text-align: center; margin-bottom: 1.5rem; }
        .retry { font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #fbbf24; background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.2); padding: 0.5rem 1rem; border-radius: 10px; margin-bottom: 2rem; }
        .badge { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #6b7280; margin-top: 3rem; }
    </style>
</head>
<body>
    <a href="/" class="logo">
        <div class="logo-icon">E</div>
        <span class="logo-text">EduCode</span>
    </a>
    <div class="icon">🔧</div>
    <h1 class="title">Plataforma en mantenimiento</h1>
    <p class="desc">Estamos haciendo mejoras para darte una mejor experiencia. Vuelve en unos minutos.</p>
    @isset($retryAfter)
    <div class="retry">⏱ Tiempo estimado: {{ $retryAfter }} segundos</div>
    @endisset
    <span class="badge">EduCode · mantenimiento</span>
</body>
</html>
