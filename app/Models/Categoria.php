<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'CATEGORIA';
    protected $primaryKey = 'ID_CATEGORIA';
    public $timestamps = false;

    protected $fillable = [
        'NOM_CATEGORIA',
        'DESCRIPCION_CATEGORIA',
    ];

    // Relación con TITULO
    public function titulos(): HasMany
    {
        return $this->hasMany(Titulo::class, 'ID_CATEGORIA');
    }
}
