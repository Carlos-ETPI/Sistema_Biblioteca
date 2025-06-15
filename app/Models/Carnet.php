<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\TracksUserChanges;

class Carnet extends Model
{
    protected $table = 'CARNET';
    protected $primaryKey = 'ID_CARNET';
    public $timestamps = false;
    public $incrementing = true;
    use TracksUserChanges;

    protected $fillable = [
        'CARNET',
        'VENCIMIENTO_CARNET',
        'EXPEDICION_CARNET',
        'created_by',  
        'updated_by',
    ];

    // Relación con usuario (si existe la tabla USUARIO relacionada)
    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class, 'ID_CARNET');
    }
}
