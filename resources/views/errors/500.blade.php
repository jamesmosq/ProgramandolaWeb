<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Error del servidor</title>
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
                radial-gradient(ellipse 60% 40% at 20% 20%, rgba(239,68,68,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 35% at 80% 80%, rgba(124,58,237,0.06) 0%, transparent 60%);
        }
        .logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; margin-bottom: 3rem; }
        .logo-icon { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #22d3ee, #8b5cf6); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; color: white; }
        .logo-text { font-weight: 700; font-size: 1rem; color: white; }
        .code { font-family: 'JetBrains Mono', monospace; font-size: clamp(5rem, 18vw, 9rem); font-weight: 700; line-height: 1; background: linear-gradient(135deg, #fca5a5 0%, #f87171 50%, #ef4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1.5rem; }
        .title { font-size: clamp(1.25rem, 4vw, 1.75rem); font-weight: 700; margin-bottom: 0.75rem; text-align: center; }
        .desc { color: #9ca3af; font-size: 1rem; line-height: 1.6; max-width: 400px; text-align: center; margin-bottom: 2.5rem; }
        .btn-primary { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.7rem 1.5rem; background: #06b6d4; color: white; font-weight: 600; font-size: 0.9rem; border-radius: 12px; text-decoration: none; transition: background 0.2s; }
        .btn-primary:hover { background: #22d3ee; }
        .badge { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #6b7280; margin-top: 3rem; }
    </style>
</head>
<body>
    <a href="/" class="logo">
        <div class="logo-icon">E</div>
        <span class="logo-text">EduCode</span>
    </a>
    <div class="code">500</div>
    <h1 class="title">Error del servidor</h1>
    <p class="desc">Algo salió mal en el servidor. Ya estamos trabajando para resolverlo. Intenta de nuevo en unos minutos.</p>
    <a href="/" class="btn-primary">← Volver al inicio</a>
    <span class="badge">EduCode · error 500</span>
</body>
</html>
