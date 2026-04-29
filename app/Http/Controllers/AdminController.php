<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\User;
use App\Models\Progreso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(): \Illuminate\View\View
    {
        $totalLecciones = Modulo::activo()->withCount('lecciones')->get()->sum('lecciones_count');

        $usuarios = User::orderBy('created_at')
            ->withCount(['progresos as completadas' => fn ($q) =>
                $q->whereNotNull('completada_at')
            ])
            ->get()
            ->map(function (User $u) use ($totalLecciones) {
                $u->pct = $totalLecciones > 0
                    ? round(($u->completadas / $totalLecciones) * 100)
                    : 0;
                return $u;
            });

        $stats = [
            'estudiantes'  => $usuarios->count(),
            'completaciones' => $usuarios->sum('completadas'),
            'promedio_pct' => $usuarios->count() > 0 ? round($usuarios->avg('pct')) : 0,
            'total_lecciones' => $totalLecciones,
        ];

        return view('admin.dashboard', compact('usuarios', 'stats'));
    }

    public function toggleAdmin(Request $request, User $user): RedirectResponse
    {
        abort_if($request->user()->id === $user->id, 403);

        $user->update(['is_admin' => ! $user->is_admin]);

        return back()->with('success',
            $user->is_admin ? "{$user->name} ahora es administrador." : "{$user->name} ya no es administrador."
        );
    }
}
