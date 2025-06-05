<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Titulo extends Model
{
    protected $table = 'TITULO';
    protected $primaryKey = 'ID_TITULO';
    public $timestamps = false;

    protected $fillable = [
        'ID_CATALOGO',
        'ID_CATEGORIA',
        'ID_IDIOMA',
        'NOMBRE_TITULO',
        'ISBN_TITULO',
    ];

    public function catalogo(): BelongsTo
    {
        return $this->belongsTo(Catalogo::class, 'ID_CATALOGO');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'ID_CATEGORIA');
    }

    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class, 'ID_IDIOMA');
    }

    public function ejemplares(): HasMany
    {
        return $this->hasMany(Ejemplar::class, 'ID_TITULO');
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'TITULO_AUTOR', 'ID_TITULO', 'ID_AUTOR');
    }
}
