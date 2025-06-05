<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Model
{
    protected $table = 'USUARIO';
    protected $primaryKey = 'ID_USUARIO';
    public $timestamps = false;

    protected $fillable = [
        'ID_PERSONA',
        'ID_CARNET',
        'ID_ROL',
        'FECHAREGISTRO_USUARIO',
        'ESTADO_USUARIO',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class,  'ID_PERSONA');
    }

    public function carnet(): BelongsTo
    {
        return $this->belongsTo(Carnet::class, 'ID_CARNET');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'ID_ROL');
    }
}
