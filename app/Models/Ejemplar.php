<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\TracksUserChanges;

class Ejemplar extends Model
{
    protected $table = 'EJEMPLAR';
    protected $primaryKey = 'ID_EJEMPLAR';
    public $timestamps = false;
    use TracksUserChanges;

    protected $fillable = [
        'ID_TITULO',
        'ESTADO_EJEMPLAR',
        'created_by',  
        'updated_by',
    ];

    public function titulo(): BelongsTo
    {
        return $this->belongsTo(Titulo::class, 'ID_TITULO');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Presta::class, 'ID_EJEMPLAR');
    }
}
