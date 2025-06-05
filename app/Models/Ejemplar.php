<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ejemplar extends Model
{
    protected $table = 'EJEMPLAR';
    protected $primaryKey = 'ID_EJEMPLAR';
    public $timestamps = false;

    protected $fillable = [
        'ID_TITULO',
        'ESTADO_EJEMPLAR',
    ];

    public function titulo(): BelongsTo
    {
        return $this->belongsTo(Titulo::class, 'ID_TITULO');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Presta::class, 'ID_EJEMPLAR');
    }
}
