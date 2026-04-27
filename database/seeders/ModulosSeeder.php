<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use App\Models\Leccion;
use App\Models\Modulo;
use App\Models\Paso;
use Illuminate\Database\Seeder;

class ModulosSeeder extends Seeder
{
    public function run(): void
    {

        $modulos = [
            [
                'nombre'      => 'Bases de Datos',
                'descripcion' => 'SQL desde cero: diseño de tablas, relaciones, claves foráneas y consultas con JOINs.',
                'icono'       => '🗄️',
                'color'       => 'cyan',
                'orden'       => 1,
                'lecciones'   => [
                    [
                        'titulo'            => 'Introducción a bases de datos relacionales',
                        'descripcion'       => '¿Qué es una base de datos? Tablas, filas y columnas.',
                        'orden'             => 1,
                        'duracion_minutos'  => 20,
                        'pasos' => [
                            ['titulo' => '¿Qué es una base de datos?', 'tipo' => 'teoria', 'contenido' => "Una base de datos relacional organiza la información en tablas.\nCada tabla tiene columnas (campos) y filas (registros).\nEjemplo: una tabla 'modulos' con columnas id, nombre, descripcion."],
                            ['titulo' => 'Crear tu primera base de datos', 'tipo' => 'codigo', 'contenido' => "CREATE DATABASE programando;\nUSE programando;"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Escribe el SQL para crear una base de datos llamada "mi_app"', 'dificultad' => 'facil'],
                        ],
                    ],
                    [
                        'titulo'            => 'CREATE TABLE y tipos de datos',
                        'descripcion'       => 'Define la estructura de tus tablas con los tipos de datos correctos.',
                        'orden'             => 2,
                        'duracion_minutos'  => 30,
                        'pasos' => [
                            ['titulo' => 'Tipos de datos principales', 'tipo' => 'teoria', 'contenido' => "INT / BIGINT — números enteros\nVARCHAR(n) — texto corto (máx n caracteres)\nTEXT / LONGTEXT — texto largo\nBOOLEAN — verdadero/falso\nTIMESTAMP — fecha y hora\nENUM('a','b') — lista de opciones fijas"],
                            ['titulo' => 'Crear la tabla modulos', 'tipo' => 'codigo', 'contenido' => "CREATE TABLE modulos (\n    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,\n    nombre VARCHAR(120) NOT NULL,\n    descripcion TEXT,\n    icono VARCHAR(10) DEFAULT '📦',\n    color VARCHAR(20) DEFAULT 'cyan',\n    orden TINYINT UNSIGNED DEFAULT 1,\n    activo BOOLEAN DEFAULT TRUE,\n    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP\n);"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea una tabla "usuarios" con id, nombre, email y created_at', 'dificultad' => 'facil'],
                            ['enunciado' => 'Agrega una columna "activo" BOOLEAN a la tabla usuarios con ALTER TABLE', 'dificultad' => 'medio'],
                        ],
                    ],
                    [
                        'titulo'            => 'Claves foráneas y relaciones',
                        'descripcion'       => 'Conecta tablas con FOREIGN KEY y define CASCADE.',
                        'orden'             => 3,
                        'duracion_minutos'  => 35,
                        'pasos' => [
                            ['titulo' => '¿Qué es una clave foránea?', 'tipo' => 'teoria', 'contenido' => "Una FOREIGN KEY (FK) es una columna que apunta al ID de otra tabla.\nEjemplo: la tabla 'lecciones' tiene modulo_id que apunta a modulos.id\nEsto garantiza integridad referencial: no puedes crear una lección sin módulo."],
                            ['titulo' => 'Tabla lecciones con FK', 'tipo' => 'codigo', 'contenido' => "CREATE TABLE lecciones (\n    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,\n    modulo_id BIGINT UNSIGNED NOT NULL,\n    titulo VARCHAR(200) NOT NULL,\n    orden SMALLINT UNSIGNED DEFAULT 1,\n    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n    FOREIGN KEY (modulo_id) REFERENCES modulos(id) ON DELETE CASCADE\n);"],
                            ['titulo' => 'ON DELETE CASCADE', 'tipo' => 'tip', 'contenido' => "CASCADE significa que si eliminas un módulo, sus lecciones se eliminan automáticamente.\nSIN CASCADE: la base de datos lanza un error si intentas eliminar un módulo con lecciones.\nRESTRICT es el comportamiento por defecto si no especificas nada."],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea la tabla "pasos" con leccion_id como FK hacia lecciones', 'dificultad' => 'medio'],
                        ],
                    ],
                    [
                        'titulo'            => 'SELECT y JOINs',
                        'descripcion'       => 'Consulta datos de múltiples tablas relacionadas.',
                        'orden'             => 4,
                        'duracion_minutos'  => 40,
                        'pasos' => [
                            ['titulo' => 'SELECT básico', 'tipo' => 'codigo', 'contenido' => "-- Todos los registros\nSELECT * FROM modulos;\n\n-- Columnas específicas\nSELECT id, nombre, color FROM modulos WHERE activo = 1;\n\n-- Ordenar\nSELECT * FROM modulos ORDER BY orden ASC;"],
                            ['titulo' => 'INNER JOIN', 'tipo' => 'codigo', 'contenido' => "-- Lecciones con el nombre de su módulo\nSELECT\n    l.id,\n    l.titulo AS leccion,\n    m.nombre AS modulo\nFROM lecciones l\nINNER JOIN modulos m ON l.modulo_id = m.id\nORDER BY m.orden, l.orden;"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Escribe un SELECT que muestre el nombre del módulo y el total de lecciones de cada módulo usando COUNT y GROUP BY', 'dificultad' => 'dificil'],
                        ],
                    ],
                ],
            ],
            [
                'nombre'      => 'PHP Puro',
                'descripcion' => 'Variables, funciones, arrays, POO con PHP 8.3 y conexión a base de datos con PDO.',
                'icono'       => '🐘',
                'color'       => 'violet',
                'orden'       => 2,
                'lecciones'   => [
                    [
                        'titulo'            => 'Variables y tipos en PHP 8.3',
                        'descripcion'       => 'Tipos primitivos, tipado estricto y declaraciones modernas.',
                        'orden'             => 1,
                        'duracion_minutos'  => 25,
                        'pasos' => [
                            ['titulo' => 'Tipado en PHP 8', 'tipo' => 'teoria', 'contenido' => "PHP 8 introdujo tipos de unión (int|string), tipos de retorno y readonly properties.\nSiempre usa declare(strict_types=1) al inicio del archivo para forzar tipos."],
                            ['titulo' => 'Ejemplos de variables', 'tipo' => 'codigo', 'contenido' => "<?php\ndeclare(strict_types=1);\n\n\$nombre = 'EduCode';\n\$version = 11;\n\$activo = true;\n\$precio = 0.0;\n\n// Match expression (PHP 8+)\n\$mensaje = match(\$activo) {\n    true  => 'La plataforma está activa',\n    false => 'Fuera de línea',\n};"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea una variable para cada tipo (string, int, bool, float) y usa var_dump() para ver su tipo', 'dificultad' => 'facil'],
                        ],
                    ],
                    [
                        'titulo'            => 'Funciones con tipos y POO básica',
                        'descripcion'       => 'Funciones tipadas, clases, propiedades y métodos.',
                        'orden'             => 2,
                        'duracion_minutos'  => 40,
                        'pasos' => [
                            ['titulo' => 'Funciones tipadas', 'tipo' => 'codigo', 'contenido' => "function saludar(string \$nombre): string\n{\n    return \"Hola, \$nombre!\";\n}\n\nfunction sumar(int \$a, int \$b): int\n{\n    return \$a + \$b;\n}"],
                            ['titulo' => 'Clase básica', 'tipo' => 'codigo', 'contenido' => "class Modulo\n{\n    public function __construct(\n        public readonly string \$nombre,\n        public readonly string \$color = 'cyan',\n    ) {}\n\n    public function etiqueta(): string\n    {\n        return \"[{\$this->color}] {\$this->nombre}\";\n    }\n}\n\n\$m = new Modulo('Bases de Datos');\necho \$m->etiqueta();"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea una clase "Leccion" con propiedades titulo, orden y un método resumen()', 'dificultad' => 'medio'],
                        ],
                    ],
                    [
                        'titulo'            => 'PDO: conectar PHP con la base de datos',
                        'descripcion'       => 'Conexión segura, prepared statements y consultas.',
                        'orden'             => 3,
                        'duracion_minutos'  => 45,
                        'pasos' => [
                            ['titulo' => 'Conectar con PDO', 'tipo' => 'codigo', 'contenido' => "<?php\n\$dsn = 'mysql:host=localhost;dbname=programando;charset=utf8mb4';\n\$pdo = new PDO(\$dsn, 'root', '', [\n    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,\n    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n]);"],
                            ['titulo' => 'Prepared statement', 'tipo' => 'codigo', 'contenido' => "// Insertar con prepared statement (seguro contra SQL injection)\n\$stmt = \$pdo->prepare('INSERT INTO modulos (nombre, color, orden) VALUES (?, ?, ?)');\n\$stmt->execute(['PHP Puro', 'violet', 2]);\n\n// Consultar\n\$modulos = \$pdo->query('SELECT * FROM modulos ORDER BY orden')->fetchAll();"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Conecta con PDO y lista todos los módulos con un foreach que muestre nombre e icono', 'dificultad' => 'medio'],
                        ],
                    ],
                ],
            ],
            [
                'nombre'      => 'HTML & CSS',
                'descripcion' => 'Semántica HTML5, Tailwind CSS, Flexbox, Grid y diseño responsive mobile-first.',
                'icono'       => '🎨',
                'color'       => 'pink',
                'orden'       => 3,
                'lecciones'   => [
                    [
                        'titulo'            => 'HTML5 semántico',
                        'descripcion'       => 'Las etiquetas correctas para cada parte de una página.',
                        'orden'             => 1,
                        'duracion_minutos'  => 20,
                        'pasos' => [
                            ['titulo' => 'Estructura semántica', 'tipo' => 'codigo', 'contenido' => "<!DOCTYPE html>\n<html lang=\"es\">\n<head>\n    <meta charset=\"UTF-8\">\n    <title>EduCode</title>\n</head>\n<body>\n    <header><!-- Cabecera / navbar --></header>\n    <main>\n        <section><!-- Sección de contenido --></section>\n        <article><!-- Artículo independiente --></article>\n    </main>\n    <footer><!-- Pie de página --></footer>\n</body>\n</html>"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea el esqueleto HTML de la landing page de EduCode usando etiquetas semánticas', 'dificultad' => 'facil'],
                        ],
                    ],
                    [
                        'titulo'            => 'Tailwind CSS: utilidades y diseño',
                        'descripcion'       => 'Clases utility-first para construir interfaces rápido.',
                        'orden'             => 2,
                        'duracion_minutos'  => 35,
                        'pasos' => [
                            ['titulo' => 'Incluir Tailwind vía CDN', 'tipo' => 'codigo', 'contenido' => "<script src=\"https://cdn.tailwindcss.com\"></script>\n\n<!-- Luego usa clases directamente -->\n<div class=\"bg-gray-950 text-white min-h-screen p-8\">\n    <h1 class=\"text-4xl font-extrabold text-cyan-400\">EduCode</h1>\n    <p class=\"text-gray-400 mt-2\">Aprende programación paso a paso</p>\n</div>"],
                            ['titulo' => 'Flexbox con Tailwind', 'tipo' => 'codigo', 'contenido' => "<nav class=\"flex items-center justify-between h-16 px-6 bg-gray-900\">\n    <span class=\"font-bold\">EduCode</span>\n    <div class=\"flex items-center gap-4\">\n        <a href=\"#\" class=\"text-gray-400 hover:text-white\">Módulos</a>\n        <a href=\"#\" class=\"px-4 py-2 bg-cyan-500 rounded-xl text-white\">Entrar</a>\n    </div>\n</nav>"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Construye un card de módulo con Tailwind: icono, título, descripción y etiquetas de tags', 'dificultad' => 'medio'],
                        ],
                    ],
                    [
                        'titulo'            => 'CSS Grid y responsive design',
                        'descripcion'       => 'Layouts en cuadrícula y breakpoints mobile-first.',
                        'orden'             => 3,
                        'duracion_minutos'  => 40,
                        'pasos' => [
                            ['titulo' => 'Grid de módulos responsive', 'tipo' => 'codigo', 'contenido' => "<!-- 1 columna en móvil, 2 en tablet, 3 en desktop -->\n<div class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5\">\n    <div class=\"bg-gray-900 rounded-2xl p-6\">Módulo 1</div>\n    <div class=\"bg-gray-900 rounded-2xl p-6\">Módulo 2</div>\n    <div class=\"bg-gray-900 rounded-2xl p-6\">Módulo 3</div>\n</div>"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea un grid de 5 cards de módulo que sea responsive: 1 col en móvil, 2 en sm, 3 en lg', 'dificultad' => 'medio'],
                            ['enunciado' => 'Agrega hover:(-translate-y-1) y una transición suave a cada card', 'dificultad' => 'facil'],
                        ],
                    ],
                ],
            ],
            [
                'nombre'      => 'Laravel 11',
                'descripcion' => 'MVC, Eloquent, Blade, autenticación con Breeze y deploy en Railway.',
                'icono'       => '⚡',
                'color'       => 'orange',
                'orden'       => 4,
                'lecciones'   => [
                    [
                        'titulo'            => 'Instalación y estructura del proyecto',
                        'descripcion'       => 'Cómo crear un proyecto Laravel y entender su organización.',
                        'orden'             => 1,
                        'duracion_minutos'  => 25,
                        'pasos' => [
                            ['titulo' => 'Crear proyecto Laravel', 'tipo' => 'codigo', 'contenido' => "composer create-project laravel/laravel mi-app\ncd mi-app\nphp artisan serve"],
                            ['titulo' => 'Estructura de carpetas', 'tipo' => 'teoria', 'contenido' => "app/Models/        — Modelos Eloquent\napp/Http/Controllers/ — Controladores\nroutes/web.php     — Rutas web\nresources/views/   — Vistas Blade\ndatabase/migrations/ — Migraciones\n.env               — Variables de entorno"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Configura el .env con tus credenciales de base de datos y ejecuta php artisan migrate', 'dificultad' => 'facil'],
                        ],
                    ],
                    [
                        'titulo'            => 'Migraciones y Eloquent',
                        'descripcion'       => 'Define el schema con migraciones y usa Eloquent para consultar.',
                        'orden'             => 2,
                        'duracion_minutos'  => 45,
                        'pasos' => [
                            ['titulo' => 'Crear una migración', 'tipo' => 'codigo', 'contenido' => "php artisan make:migration create_modulos_table\n\n// En el archivo generado:\npublic function up(): void\n{\n    Schema::create('modulos', function (Blueprint \$table) {\n        \$table->id();\n        \$table->string('nombre');\n        \$table->string('color', 20)->default('cyan');\n        \$table->unsignedTinyInteger('orden')->default(1);\n        \$table->boolean('activo')->default(true);\n        \$table->timestamps();\n    });\n}"],
                            ['titulo' => 'Modelo Eloquent con relaciones', 'tipo' => 'codigo', 'contenido' => "class Modulo extends Model\n{\n    protected \$fillable = ['nombre', 'color', 'orden', 'activo'];\n\n    public function lecciones(): HasMany\n    {\n        return \$this->hasMany(Leccion::class)->orderBy('orden');\n    }\n}"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea el modelo Leccion con su migración y define la relación belongsTo hacia Modulo', 'dificultad' => 'medio'],
                        ],
                    ],
                    [
                        'titulo'            => 'Rutas, controladores y vistas Blade',
                        'descripcion'       => 'El flujo completo MVC de una petición HTTP.',
                        'orden'             => 3,
                        'duracion_minutos'  => 50,
                        'pasos' => [
                            ['titulo' => 'Rutas en web.php', 'tipo' => 'codigo', 'contenido' => "use App\\Http\\Controllers\\ModuloController;\n\nRoute::middleware(['auth'])->group(function () {\n    Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');\n    Route::get('/modulos/{modulo}', [ModuloController::class, 'show'])->name('modulos.show');\n});"],
                            ['titulo' => 'Controlador con Eloquent', 'tipo' => 'codigo', 'contenido' => "class ModuloController extends Controller\n{\n    public function index()\n    {\n        \$modulos = Modulo::where('activo', true)\n            ->orderBy('orden')\n            ->withCount('lecciones')\n            ->get();\n\n        return view('modulos.index', compact('modulos'));\n    }\n}"],
                            ['titulo' => 'Vista Blade', 'tipo' => 'codigo', 'contenido' => "@foreach(\$modulos as \$modulo)\n<div class=\"card\">\n    <h3>{{ \$modulo->nombre }}</h3>\n    <p>{{ \$modulo->lecciones_count }} lecciones</p>\n    <a href=\"{{ route('modulos.show', \$modulo) }}\">Ver →</a>\n</div>\n@endforeach"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Crea una ruta GET /perfil que muestre el nombre y email del usuario autenticado', 'dificultad' => 'medio'],
                            ['enunciado' => 'Agrega un LeccionController con método show que reciba $modulo y $leccion como parámetros', 'dificultad' => 'dificil'],
                        ],
                    ],
                    [
                        'titulo'            => 'Autenticación con Breeze',
                        'descripcion'       => 'Instala y personaliza el sistema de login/registro.',
                        'orden'             => 4,
                        'duracion_minutos'  => 30,
                        'pasos' => [
                            ['titulo' => 'Instalar Breeze', 'tipo' => 'codigo', 'contenido' => "composer require laravel/breeze --dev\nphp artisan breeze:install blade\nnpm install && npm run dev\nphp artisan migrate"],
                            ['titulo' => 'Proteger rutas con middleware', 'tipo' => 'codigo', 'contenido' => "// En web.php:\nRoute::middleware(['auth', 'verified'])->group(function () {\n    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');\n});\n\n// En vistas Blade:\n@auth\n    <a href=\"/dashboard\">Mi dashboard</a>\n@else\n    <a href=\"/login\">Ingresar</a>\n@endauth"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Personaliza la vista resources/views/auth/login.blade.php con el tema oscuro de EduCode', 'dificultad' => 'medio'],
                        ],
                    ],
                ],
            ],
            [
                'nombre'      => 'Laravel Moonshine',
                'descripcion' => 'Panel de administración con Resources, Fields, Actions y relaciones HasMany inline.',
                'icono'       => '🌙',
                'color'       => 'purple',
                'orden'       => 5,
                'lecciones'   => [
                    [
                        'titulo'            => 'Instalación y primer Resource',
                        'descripcion'       => 'Instala Moonshine y genera el panel de administración.',
                        'orden'             => 1,
                        'duracion_minutos'  => 30,
                        'pasos' => [
                            ['titulo' => 'Instalar Moonshine', 'tipo' => 'codigo', 'contenido' => "composer require moonshine/moonshine\nphp artisan moonshine:install\nphp artisan moonshine:user"],
                            ['titulo' => 'Generar un Resource', 'tipo' => 'codigo', 'contenido' => "php artisan moonshine:resource ModuloResource --model=Modulo\n\n// En app/MoonShine/Resources/ModuloResource.php:\npublic function fields(): array\n{\n    return [\n        ID::make(),\n        Text::make('Nombre', 'nombre'),\n        Text::make('Icono', 'icono'),\n        Select::make('Color', 'color')\n            ->options(['cyan', 'violet', 'pink', 'orange', 'purple']),\n        Number::make('Orden', 'orden'),\n        Switcher::make('Activo', 'activo'),\n    ];\n}"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Instala Moonshine y accede al panel en /admin. Crea el primer módulo desde la interfaz', 'dificultad' => 'facil'],
                        ],
                    ],
                    [
                        'titulo'            => 'Relaciones y HasMany inline',
                        'descripcion'       => 'Gestiona lecciones desde el panel del módulo.',
                        'orden'             => 2,
                        'duracion_minutos'  => 40,
                        'pasos' => [
                            ['titulo' => 'HasMany inline en Moonshine', 'tipo' => 'codigo', 'contenido' => "// En ModuloResource:\nuse MoonShine\\Fields\\Relationships\\HasMany;\n\npublic function fields(): array\n{\n    return [\n        // ... campos del módulo ...\n        HasMany::make('Lecciones', 'lecciones', LeccionResource::class),\n    ];\n}"],
                            ['titulo' => 'BelongsTo con búsqueda', 'tipo' => 'codigo', 'contenido' => "// En LeccionResource:\nuse MoonShine\\Fields\\Relationships\\BelongsTo;\n\nBelongsTo::make('Módulo', 'modulo', ModuloResource::class)\n    ->searchable(),"],
                        ],
                        'ejercicios' => [
                            ['enunciado' => 'Agrega el HasMany de lecciones al ModuloResource y crea una lección desde el panel', 'dificultad' => 'medio'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($modulos as $moduloData) {
            $lecciones = $moduloData['lecciones'] ?? [];
            unset($moduloData['lecciones']);

            $modulo = Modulo::updateOrCreate(
                ['orden' => $moduloData['orden']],
                $moduloData
            );

            foreach ($lecciones as $leccionData) {
                $pasos     = $leccionData['pasos'] ?? [];
                $ejercicios = $leccionData['ejercicios'] ?? [];
                unset($leccionData['pasos'], $leccionData['ejercicios']);

                $leccion = Leccion::updateOrCreate(
                    ['modulo_id' => $modulo->id, 'orden' => $leccionData['orden']],
                    [...$leccionData, 'modulo_id' => $modulo->id]
                );

                foreach ($pasos as $i => $paso) {
                    Paso::updateOrCreate(
                        ['leccion_id' => $leccion->id, 'orden' => $i + 1],
                        [...$paso, 'leccion_id' => $leccion->id, 'orden' => $i + 1]
                    );
                }

                foreach ($ejercicios as $i => $ejercicio) {
                    Ejercicio::updateOrCreate(
                        ['leccion_id' => $leccion->id, 'orden' => $i + 1],
                        [...$ejercicio, 'leccion_id' => $leccion->id, 'orden' => $i + 1]
                    );
                }
            }
        }
    }
}
