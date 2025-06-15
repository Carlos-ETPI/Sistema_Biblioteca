<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\TracksUserChanges;

class Presta extends Model
{
    protected $table = 'PRESTA';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
    use TracksUserChanges;

    protected $fillable = [
        'ID_EJEMPLAR',
        'ID_USUARIO',
        'ID_PRESTA',
        'ID_COSTO_PRESTA',
        'ESTADO_PRESTA',
        'FECHA_PRESTA',
        'FECHA_DEVO',
        'created_by',  
        'updated_by',
    ];

    public function ejemplar(): BelongsTo
    {
        return $this->belongsTo(Ejemplar::class, 'ID_EJEMPLAR');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'ID_USUARIO');
    }

    public function costo(): BelongsTo
    {
        return $this->belongsTo(CostoPresta::class, 'ID_COSTO_PRESTA');
    }
}
