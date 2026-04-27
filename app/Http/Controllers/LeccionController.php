<?php

namespace App\Http\Controllers;

use App\Models\Leccion;
use App\Models\Modulo;
use App\Models\Progreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeccionController extends Controller
{
    public function show(Modulo $modulo, Leccion $leccion)
    {
        abort_unless($leccion->modulo_id === $modulo->id, 404);
        abort_unless($leccion->activa, 404);

        $userId = Auth::id();
        $pasos = $leccion->pasos;
        $ejercicios = $leccion->ejercicios;
        $completada = $leccion->completadaPor($userId);

        $anterior = $modulo->lecciones()
            ->where('activa', true)
            ->where('orden', '<', $leccion->orden)
            ->orderByDesc('orden')
            ->first();

        $siguiente = $modulo->lecciones()
            ->where('activa', true)
            ->where('orden', '>', $leccion->orden)
            ->orderBy('orden')
            ->first();

        return view('lecciones.show', compact(
            'modulo', 'leccion', 'pasos', 'ejercicios', 'completada', 'anterior', 'siguiente'
        ));
    }

    public function completar(Modulo $modulo, Leccion $leccion)
    {
        abort_unless($leccion->modulo_id === $modulo->id, 404);

        Progreso::updateOrCreate(
            ['user_id' => Auth::id(), 'leccion_id' => $leccion->id],
            ['completada_at' => now()]
        );

        return back()->with('success', '¡Lección marcada como completada! ✅');
    }
}
