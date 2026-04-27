# CLAUDE.md — EduCode · Plataforma Educativa

## Contexto del proyecto

Plataforma educativa tipo micro-LMS construida con **Laravel 11**, destinada a estudiantes de programación. Permite aprender paso a paso los temas que el instructor enseña: Bases de Datos, PHP, HTML/CSS, Laravel, Laravel Moonshine y Diseño Móvil.

El instructor es **James**, desarrollador con JetBrains, experto en Laravel, Railway y el stack colombiano de educación técnica.

---

## Marca — REGLA ESTRICTA

La plataforma se llama **EduCode** y solo EduCode.

- ❌ Nunca usar "CEFIT", "CEFIT-SENA" ni "EduCode CEFIT" en: badges, títulos, footers, nombres de app en ejemplos de código, variables de entorno (`APP_NAME`, `MAIL_FROM_NAME`) ni en ningún elemento visible al estudiante.
- ✅ CEFIT/SENA solo puede aparecer como **contexto institucional** en comentarios internos o documentación técnica (p.ej. "diseñado para uso en CEFIT-SENA"), nunca en la UI.
- Al generar guías HTML o ejemplos de código, usar siempre `'EduCode'` como nombre de la app, nunca `'EduCode CEFIT'`.

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| Framework | Laravel 11 |
| Auth | Laravel Breeze (Blade + Alpine.js) |
| Admin panel | Integrado — `/admin/dashboard` con `EnsureIsAdmin` middleware |
| Base de datos | MySQL (Railway) |
| Frontend | Blade + Tailwind CSS v3 + Alpine.js |
| Deploy | Railway (paid plan) |
| Correo | Gmail SMTP (`contaeducolombia@gmail.com`) |
| IDE | JetBrains PhpStorm |
| Local | Laravel Herd + WAMP (Windows) |

---

## Arquitectura de la aplicación

```
app/
├── Models/
│   ├── Modulo.php
│   ├── Leccion.php
│   ├── Paso.php
│   ├── Ejercicio.php
│   └── Progreso.php
├── Http/Controllers/
│   ├── ModuloController.php
│   ├── LeccionController.php
│   ├── GuiaController.php      ← sirve las guías HTML con navbar inyectada
│   └── ProgresoController.php
└── Http/Middleware/EnsureIsAdmin.php

resources/
├── views/
│   ├── layouts/app.blade.php
│   ├── modulos/index.blade.php
│   ├── modulos/show.blade.php  ← guías hardcodeadas por $modulo->orden
│   └── lecciones/show.blade.php
└── guias/                      ← archivos HTML servidos por GuiaController
    ├── guia_sql_mysql.html
    ├── guia_php.html
    ├── guia_bootstrap.html
    ├── guia_laravel.html
    ├── guia_laravel13.html
    ├── guia_moonshine.html
    ├── guia_moonshine4.html
    ├── guia_flutter.html
    └── guia_flet.html

DataProducts/                   ← fuente original de guías y talleres
```

---

## Sistema de guías HTML

Las guías son archivos `.html` standalone que `GuiaController` sirve con una navbar inyectada dinámicamente. Al agregar una guía nueva:

1. Copiar el `.html` a `resources/guias/`
2. Añadir el nombre al array `$archivosPermitidos['guias']` en `GuiaController`
3. Vincular en `$guias[$modulo->orden]` dentro de `resources/views/modulos/show.blade.php`
4. Correr `npm run build` si se tocaron vistas Blade

---

## Modelo de base de datos

```sql
modulos:   id, nombre, descripcion, icono, color, orden, activo, timestamps
lecciones: id, modulo_id(FK), titulo, descripcion, orden, duracion_minutos, activa, timestamps
pasos:     id, leccion_id(FK), titulo, contenido(LONGTEXT), tipo(ENUM:teoria,codigo,tip), orden, timestamps
ejercicios:id, leccion_id(FK), enunciado(TEXT), dificultad(ENUM:facil,medio,dificil), orden, timestamps
progresos: id, user_id(FK), leccion_id(FK), completada_at(TIMESTAMP nullable), timestamps
           UNIQUE KEY (user_id, leccion_id)
```

---

## Módulos de contenido (en orden)

| # | Nombre | Color | Icono (`icono`) |
|---|--------|-------|-----------------|
| 1 | Bases de Datos | cyan | `database` |
| 2 | PHP Puro | violet | `code` |
| 3 | HTML & CSS | pink | `design` |
| 4 | Laravel 11 | orange | `bolt` |
| 5 | Laravel Moonshine | purple | `moon` |
| 6 | Diseño Móvil | emerald | `mobile` |

El campo `icono` en el seeder es **siempre un string de nombre de icono** (nunca un emoji). Los iconos disponibles están definidos en `resources/views/components/icon.blade.php`. Al agregar un nuevo módulo hay que elegir un nombre de icono existente o añadirlo al componente.

Al agregar un nuevo módulo hay que añadir su color al array `$colores` en `modulos/index.blade.php`.

### Landing page — OBLIGATORIO al agregar módulos

Cada vez que se añade un módulo nuevo, actualizar **`resources/views/welcome.blade.php`**:

1. **Stat de módulos** — cambiar el número en el array `['N', 'Módulos']` del hero
2. **Encabezado de sección** — `"N módulos, una ruta clara"`
3. **Tarjeta del módulo** — añadir card en el grid de `#modulos` con `<x-icon name="ICONO" class="w-8 h-8 text-COLOR-400" />`, nombre, descripción y tags con el color correspondiente. Con 6+ módulos el grid de 3 cols ya no necesita `sm:col-span-2` en el último.
4. **Ruta de aprendizaje** — añadir paso en el array de `#ruta` con el nombre del icono (string, no emoji), título corto, descripción y color
5. **Condición step-line** — ajustar `$i < N-1` para que la línea conectora no aparezca en el último paso
6. **Clase del color** — añadir la entrada `'bg-COLOR-400/10 border-COLOR-400/40 text-COLOR-400' => $color === 'COLOR'` al `@class` del número de paso

---

## Reglas de desarrollo

### General
- Código en **español** para variables de negocio (nombre, descripcion, activo)
- Comentarios en español
- Inglés solo para convenciones de Laravel (models, controllers, migrations)
- Siempre `ENGINE=InnoDB` y `charset=utf8mb4` en migraciones

### Migraciones
- Orden: tablas padre antes que hijas (modulos → lecciones → pasos → ejercicios → progresos)
- Usar `foreignId()->constrained()->cascadeOnDelete()` siempre
- Siempre incluir `->after('columna')` al agregar columnas con `ALTER`

### Modelos
- Siempre definir `$fillable` explícitamente
- Definir todas las relaciones `hasMany` / `belongsTo`
- Usar `$casts` para booleanos y enums

### Blade / Frontend
- Tailwind CSS v3 — NO usar clases arbitrarias innecesarias
- Alpine.js para interactividad ligera (tabs, acordeones, progress)
- Sin Vue, sin React — Blade puro
- Componentes anónimos en `resources/views/components/`

### Iconos SVG — REGLA ESTRICTA
- ❌ Nunca usar emojis como iconos en ninguna vista Blade (`🗄️`, `⚡`, `📱`, etc.)
- ✅ Usar siempre el componente `<x-icon name="NOMBRE" class="w-N h-N text-COLOR" />`
- Los iconos disponibles están en `resources/views/components/icon.blade.php`. Si el icono necesario no existe, añadirlo ahí antes de usarlo.
- El campo `icono` del seeder (`ModulosSeeder.php`) es un string de nombre de icono, nunca un emoji.
- En páginas sin Tailwind (ej. `errors/503.blade.php`), usar SVG inline con `style="width:Npx;height:Npx;"` en lugar de `<x-icon>`.

### Admin integrado
- Ruta: `GET /admin/dashboard` protegida por middleware `admin` (`EnsureIsAdmin`)
- Columna `is_admin` boolean en tabla `users` (default false)
- Para promover un usuario: `User::where('email', '...')->update(['is_admin' => true])` via tinker, o desde el panel admin UI
- El admin puede ver stats globales y promover/degradar otros usuarios desde `/admin/dashboard`
- No instalar Moonshine ni Spatie Permission — el sistema de roles es propio y simple

---

## Variables de entorno Railway (producción)

```env
APP_NAME="EduCode"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://[TU-DOMINIO].up.railway.app

DB_CONNECTION=mysql
DB_HOST=[Railway MySQL host]
DB_PORT=3306
DB_DATABASE=educode_db
DB_USERNAME=[Railway user]
DB_PASSWORD=[Railway password]

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=contaeducolombia@gmail.com
MAIL_PASSWORD=[APP_PASSWORD_NUEVA]
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contaeducolombia@gmail.com
MAIL_FROM_NAME="EduCode"

CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

---

## Comandos frecuentes

```bash
# Desarrollo local
php artisan serve
npm run dev
npm run build

# Seeder principal (único seeder del proyecto)
php artisan db:seed --class=ModulosSeeder

# Reset completo local
php artisan migrate:fresh --seed

# Railway deploy
railway up
railway run php artisan migrate --force
railway run php artisan db:seed --class=ModulosSeeder --force
```

---

## Lo que Claude Code debe hacer

1. Leer este archivo completo antes de generar cualquier código
2. Respetar la regla de marca EduCode — nunca CEFIT/SENA en UI o código
3. Respetar el orden de migraciones (padre → hijo)
4. Al agregar módulos: seeder (con `icono` como string de nombre, no emoji) + color en index.blade.php + guias en show.blade.php + GuiaController + npm run build
5. Blade views deben ser limpias, semánticas y usar los componentes definidos — nunca emojis como iconos
6. No instalar paquetes adicionales sin consultar

---

## Notas importantes

- La App Password de Gmail **debe ser nueva** (la anterior fue expuesta). Generar en myaccount.google.com/apppasswords
- Railway tiene plan de pago — no preocuparse por límites de free tier
- El contenido de lecciones (pasos) puede ser HTML o Markdown — el campo `contenido` es LONGTEXT
- Las guías HTML en `resources/guias/` reciben una navbar inyectada automáticamente por `GuiaController`
