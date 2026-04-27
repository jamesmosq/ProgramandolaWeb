<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paso extends Model
{
    protected $fillable = ['leccion_id', 'titulo', 'contenido', 'tipo', 'orden'];

    public function leccion(): BelongsTo
    {
        return $this->belongsTo(Leccion::class);
    }
}
