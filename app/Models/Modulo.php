<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modulo extends Model
{
    protected $table = 'modulos';

    protected $fillable = ['nombre', 'descripcion', 'icono', 'color', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function lecciones(): HasMany
    {
        return $this->hasMany(Leccion::class)->orderBy('orden');
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
