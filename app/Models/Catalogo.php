<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalogo extends Model
{
    protected $table = 'CATALOGO';
    protected $primaryKey = 'ID_CATALOGO';
    public $timestamps = false;

    protected $fillable = [
        'BIBLIOTECA_CATALOGO',
    ];

    // Relación con bibliotecarios (uno a muchos)
    public function bibliotecarios(): HasMany
    {
        return $this->hasMany(Bibliotecario::class, 'ID_CATALOGO');
    }

    // Relación con títulos (uno a muchos)
    public function titulos(): HasMany
    {
        return $this->hasMany(Titulo::class, 'ID_CATALOGO');
    }
}
