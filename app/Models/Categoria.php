<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\TracksUserChanges;

class Categoria extends Model
{
    protected $table = 'CATEGORIA';
    protected $primaryKey = 'ID_CATEGORIA';
    public $timestamps = false;
    use TracksUserChanges;

    protected $fillable = [
        'NOM_CATEGORIA',
        'DESCRIPCION_CATEGORIA',
        'created_by',  
        'updated_by',
    ];

    // Relación con TITULO
    public function titulos(): HasMany
    {
        return $this->hasMany(Titulo::class, 'ID_CATEGORIA');
    }
}
