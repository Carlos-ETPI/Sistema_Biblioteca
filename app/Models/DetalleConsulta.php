<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleConsulta extends Model
{
    protected $table = 'DETALLE_CONSULTA';
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'ID_BIBLIOTECARIO',
        'ID_USUARIO',
        'TITULOS_DETALLECONSULTA',
        'COSTO_DETALLECONSULTA',
        'FECHA_DETALLECONSULTA',
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
