<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bibliotecario extends Model
{
    protected $table = 'BIBLIOTECARIO';
    protected $primaryKey = 'ID_BIBLIOTECARIO';
    public $timestamps = false;

    protected $fillable = [
        'ID_CATALOGO',
        'NOMBRE_BIBLIOTECARIO',
        'APELLIDO_BIBLIOTECARIO',
    ];

    // Relación con la tabla CATALOGO
    public function catalogo(): BelongsTo
    {
        return $this->belongsTo(Catalogo::class, 'ID_CATALOGO');
    }
}
