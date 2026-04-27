<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leccion extends Model
{
    protected $table = 'lecciones';

    protected $fillable = ['modulo_id', 'titulo', 'descripcion', 'orden', 'duracion_minutos', 'activa'];

    protected $casts = ['activa' => 'boolean'];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class);
    }

    public function pasos(): HasMany
    {
        return $this->hasMany(Paso::class)->orderBy('orden');
    }

    public function ejercicios(): HasMany
    {
        return $this->hasMany(Ejercicio::class)->orderBy('orden');
    }

    public function progresos(): HasMany
    {
        return $this->hasMany(Progreso::class);
    }

    public function completadaPor(int $userId): bool
    {
        return $this->progresos()->where('user_id', $userId)->whereNotNull('completada_at')->exists();
    }
}
