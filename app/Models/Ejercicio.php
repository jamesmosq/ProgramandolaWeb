<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ejercicio extends Model
{
    protected $table = 'ejercicios';

    protected $fillable = ['leccion_id', 'enunciado', 'descripcion', 'solucion', 'dificultad', 'orden'];

    public function leccion(): BelongsTo
    {
        return $this->belongsTo(Leccion::class);
    }
}
