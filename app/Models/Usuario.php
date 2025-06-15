<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\TracksUserChanges;

class Usuario extends Model
{
    use TracksUserChanges;
    protected $table = 'USUARIO';
    protected $primaryKey = 'ID_USUARIO';
    public $timestamps = true;

    protected $fillable = [
        'ID_PERSONA',
        'ID_CARNET',
        'ID_ROL',
        'FECHAREGISTRO_USUARIO',
        'ESTADO_USUARIO',
        'created_by',  
        'updated_by',
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
