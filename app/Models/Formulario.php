<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formulario extends Model
{
    protected $table = 'FORMULARIO';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'ID_USUARIO',
        'ID_FORMULARIO',
        'ID_BIBLIOTECARIO',
        'APROBACION_FORMULARIO',
        'COMENTARIOS',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'ID_USUARIO');
    }

    public function bibliotecario(): BelongsTo
    {
        return $this->belongsTo(Bibliotecario::class, 'ID_BIBLIOTECARIO');
    }
}
