<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    protected $table = 'PERSONA';
    protected $primaryKey = 'ID_PERSONA';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'NOMBRE_PERSONA',
        'APELLIDO_PERSONA',
        'NACIMIENTO_PERSONA',
        'TELEFONO_PERSONA',
        'DUI_PERSONA',
    ];

    // Relación con USUARIO
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'ID_PERSONA', 'ID_PERSONA')
                    ->whereColumn('DUI_PERSONA', 'DUI_PERSONA');
    }

}
