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
        .icon { width: 5rem; height: 5rem; margin: 0 auto 1.5rem; color: #fbbf24; }
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
    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"/></svg>
    <h1 class="title">Plataforma en mantenimiento</h1>
    <p class="desc">Estamos haciendo mejoras para darte una mejor experiencia. Vuelve en unos minutos.</p>
    @isset($retryAfter)
    <div class="retry"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:14px;height:14px;display:inline;vertical-align:middle;margin-right:0.3rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>Tiempo estimado: {{ $retryAfter }} segundos</div>
    @endisset
    <span class="badge">EduCode · mantenimiento</span>
</body>
</html>
