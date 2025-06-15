<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\TracksUserChanges;

class Persona extends Model
{
    protected $table = 'PERSONA';
    protected $primaryKey = 'ID_PERSONA';
    public $incrementing = true;
    public $timestamps = false;
    use TracksUserChanges;

    protected $fillable = [
        'NOMBRE_PERSONA',
        'APELLIDO_PERSONA',
        'NACIMIENTO_PERSONA',
        'TELEFONO_PERSONA',
        'DUI_PERSONA',
        'created_by',  
        'updated_by',
    ];

    // Relación con USUARIO
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'ID_PERSONA', 'ID_PERSONA')
                    ->whereColumn('DUI_PERSONA', 'DUI_PERSONA');
    }

}
