<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\LeccionController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ProfileController;
use App\Models\Modulo;
use App\Models\Progreso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $modulos = Modulo::activo()
            ->withCount('lecciones')
            ->withCount(['lecciones as completadas_count' => function ($q) use ($userId) {
                $q->whereHas('progresos', fn ($p) =>
                    $p->where('user_id', $userId)->whereNotNull('completada_at')
                );
            }])
            ->get();

        $totalLecciones = $modulos->sum('lecciones_count');
        $completadas = $modulos->sum('completadas_count');
        $modulosCompletados = $modulos->filter(
            fn ($m) => $m->lecciones_count > 0 && $m->completadas_count === $m->lecciones_count
        )->count();

        $progreso = [
            'total'               => $totalLecciones,
            'completadas'         => $completadas,
            'modulos_total'       => $modulos->count(),
            'modulos_completados' => $modulosCompletados,
            'porcentaje'          => $totalLecciones > 0 ? round(($completadas / $totalLecciones) * 100) : 0,
        ];

        return view('dashboard', compact('modulos', 'progreso'));
    })->name('dashboard');

    Route::get('/modulos', [ModuloController::class, 'index'])->name('modulos.index');
    Route::get('/modulos/{modulo}', [ModuloController::class, 'show'])->name('modulos.show');
    Route::get('/modulos/{modulo}/lecciones/{leccion}', [LeccionController::class, 'show'])->name('lecciones.show');
    Route::post('/modulos/{modulo}/lecciones/{leccion}/completar', [LeccionController::class, 'completar'])->name('lecciones.completar');

    Route::get('/guias/{nombre}', [GuiaController::class, 'guia'])->name('guias.show');
    Route::get('/talleres/{nombre}', [GuiaController::class, 'taller'])->name('talleres.show');

    Route::get('/proyectos', fn () => view('proyectos.index'))->name('proyectos.index');
    Route::get('/proyectos/{nombre}', [GuiaController::class, 'proyecto'])->name('proyectos.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/usuarios/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('toggle');
});

require __DIR__.'/auth.php';
