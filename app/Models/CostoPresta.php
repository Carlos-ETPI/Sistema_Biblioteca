<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\TracksUserChanges;

class CostoPresta extends Model
{
    protected $table = 'COSTO_PRESTA';
    protected $primaryKey = 'ID_COSTO_PRESTA';
    public $timestamps = false;
    use TracksUserChanges;

    protected $fillable = [
        'COSTO_PRESTA',
        'MORA_PRESTA',
        'ESTADO_CANCELADO',
        'MONTO_CANCELADO',
        'created_by',  
        'updated_by',
    ];

    // Relación con PRESTA (uno a muchos)
    public function prestamos(): HasMany
    {
        return $this->hasMany(Presta::class, 'ID_COSTO_PRESTA');
    }
}
