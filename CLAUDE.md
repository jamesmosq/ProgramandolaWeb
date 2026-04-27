# CLAUDE.md — Plataforma Educativa CEFIT

## Contexto del proyecto

Plataforma educativa tipo micro-LMS construida con **Laravel 11**, destinada a estudiantes de programación de **CEFIT-SENA** y otras instituciones. Permite aprender paso a paso los temas que el instructor enseña: Bases de Datos, PHP, HTML/CSS, Laravel y Laravel Moonshine.

El instructor es **James**, desarrollador con JetBrains, experto en Laravel, Railway y el stack colombiano de educación técnica.

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| Framework | Laravel 11 |
| Auth | Laravel Breeze (Blade + Alpine.js) |
| Admin panel | Laravel Moonshine v3 |
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
│   ├── Modulo.php          # Módulo de curso (BD, PHP, Laravel…)
│   ├── Leccion.php         # Lección dentro de un módulo
│   ├── Paso.php            # Paso de contenido dentro de una lección
│   ├── Ejercicio.php       # Ejercicio propuesto al final de lección
│   └── Progreso.php        # Relación usuario-lección (completado/no)
├── Http/Controllers/
│   ├── ModuloController.php
│   ├── LeccionController.php
│   └── ProgresoController.php
└── MoonShine/Resources/    # Resources de Moonshine para admin
    ├── ModuloResource.php
    ├── LeccionResource.php
    ├── PasoResource.php
    └── EjercicioResource.php

resources/views/
├── layouts/
│   ├── app.blade.php       # Layout principal autenticado
│   └── guest.blade.php     # Layout login/registro
├── modulos/
│   ├── index.blade.php     # Lista de módulos (home del estudiante)
│   └── show.blade.php      # Detalle módulo → lista de lecciones
├── lecciones/
│   └── show.blade.php      # Lección con pasos + ejercicios
└── components/
    ├── paso-card.blade.php
    ├── ejercicio-card.blade.php
    └── progreso-bar.blade.php
```

---

## Modelo de base de datos

```sql
-- Módulos (BD, PHP, HTML/CSS, Laravel, Moonshine)
modulos: id, nombre, descripcion, icono, orden, activo, timestamps

-- Lecciones dentro de un módulo
lecciones: id, modulo_id(FK), titulo, descripcion, orden, activo, timestamps

-- Pasos dentro de una lección (contenido HTML o Markdown)
pasos: id, leccion_id(FK), titulo, contenido(LONGTEXT), tipo(ENUM:teoria,codigo,tip,advertencia), orden, timestamps

-- Ejercicios propuestos al final de cada lección
ejercicios: id, leccion_id(FK), enunciado(TEXT), dificultad(ENUM:basico,intermedio,avanzado), solucion_visible(BOOL), solucion(TEXT nullable), orden, timestamps

-- Progreso del estudiante
progresos: id, user_id(FK), leccion_id(FK), completado_at(TIMESTAMP nullable), timestamps
UNIQUE KEY (user_id, leccion_id)
```

---

## Módulos de contenido (en orden)

1. **Bases de Datos** — SQL, MySQL, normalización, scripts, CASCADE
2. **PHP Puro** — sintaxis, funciones, arrays, OOP, formularios
3. **HTML & CSS** — estructura, semántica, Flexbox, Grid, responsive
4. **Laravel** — instalación, MVC, rutas, Eloquent, Blade, Breeze
5. **Laravel Moonshine** — instalación, Resources, Fields, Actions, relaciones

---

## Reglas de desarrollo

### General
- Código en **español** para variables de negocio (nombre, descripcion, activo)
- Comentarios en español
- Inglés solo para convenciones de Laravel (models, controllers, migrations en inglés estándar)
- Siempre `ENGINE=InnoDB` y `charset=utf8mb4` en migraciones

### Migraciones
- Orden: tablas padre antes que hijas (modulos → lecciones → pasos → ejercicios → progresos)
- Usar `foreignId()->constrained()->cascadeOnDelete()` siempre
- Siempre incluir `->after('columna')` al agregar columnas con `ALTER`

### Modelos
- Siempre definir `$fillable` explícitamente
- Definir todas las relaciones `hasMany` / `belongsTo`
- Usar `$casts` para booleanos y enums

### Rutas
```php
// Rutas públicas: solo landing
// Rutas auth: módulos, lecciones, progreso
// Rutas admin: prefijo /admin → Moonshine
Route::middleware('auth')->group(function () {
    Route::resource('modulos', ModuloController::class)->only(['index','show']);
    Route::resource('lecciones', LeccionController::class)->only(['show']);
    Route::post('progreso/{leccion}', [ProgresoController::class, 'marcar']);
});
```

### Blade / Frontend
- Tailwind CSS v3 — NO usar clases arbitrarias innecesarias
- Alpine.js para interactividad ligera (tabs, acordeones, progress)
- Sin Vue, sin React — Blade puro
- Componentes anónimos en `resources/views/components/`

### Moonshine (Admin)
- Un Resource por modelo principal
- Usar `BelongsTo` y `HasMany` fields para relaciones
- Ordenar campos igual que la migración
- Proteger con middleware `moonshine.auth`

---

## Variables de entorno Railway (producción)

```env
APP_NAME="EduCode CEFIT"
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
MAIL_FROM_NAME="EduCode CEFIT"

CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

---

## Comandos frecuentes

```bash
# Desarrollo local
php artisan serve
php artisan migrate:fresh --seed
php artisan moonshine:install
php artisan moonshine:resource ModuloResource

# Seeders en orden
php artisan db:seed --class=ModuloSeeder
php artisan db:seed --class=LeccionSeeder
php artisan db:seed --class=PasoSeeder

# Railway deploy
railway up
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

---

## Lo que Claude Code debe hacer

1. Leer este archivo completo antes de generar cualquier código
2. Respetar el orden de migraciones (padre → hijo)
3. Generar Moonshine Resources con los fields correctos según el modelo
4. No instalar paquetes adicionales sin consultar
5. Blade views deben ser limpias, semánticas y usar los componentes definidos
6. Todo formulario de auth usa las vistas de Breeze sin modificar la lógica, solo el estilo si se pide

---

## Notas importantes

- La App Password de Gmail **debe ser nueva** (la anterior fue expuesta). Generar en myaccount.google.com/apppasswords
- Railway tiene plan de pago — no preocuparse por límites de free tier
- El contenido de lecciones (pasos) puede ser HTML enriquecido o Markdown — el campo `contenido` es LONGTEXT
- Las guías HTML prefabricadas (MySQL, PHP, Laravel, Moonshine) se usarán como referencia visual para el frontend del estudiante
