<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idioma extends Model
{
    protected $table = 'IDIOMA';
    protected $primaryKey = 'ID_IDIOMA';
    public $timestamps = false;

    protected $fillable = [
        'IDIOMA',
    ];

    // Relación con TITULO
    public function titulos(): HasMany
    {
        return $this->hasMany(Titulo::class, 'ID_IDIOMA');
    }
}
