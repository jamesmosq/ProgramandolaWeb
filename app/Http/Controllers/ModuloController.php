<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Progreso;
use Illuminate\Support\Facades\Auth;

class ModuloController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $modulos = Modulo::activo()
            ->withCount('lecciones')
            ->withCount(['lecciones as completadas_count' => function ($q) use ($userId) {
                $q->whereHas('progresos', fn ($p) =>
                    $p->where('user_id', $userId)->whereNotNull('completada_at')
                );
            }])
            ->get();

        return view('modulos.index', compact('modulos'));
    }

    public function show(Modulo $modulo)
    {
        $userId = Auth::id();

        $lecciones = $modulo->lecciones()
            ->where('activa', true)
            ->withCount('pasos')
            ->withCount('ejercicios')
            ->get()
            ->map(function ($leccion) use ($userId) {
                $leccion->completada = $leccion->completadaPor($userId);
                return $leccion;
            });

        $completadas = $lecciones->where('completada', true)->count();

        return view('modulos.show', compact('modulo', 'lecciones', 'completadas'));
    }
}
