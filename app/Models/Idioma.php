<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\TracksUserChanges;

class Idioma extends Model
{
    protected $table = 'IDIOMA';
    protected $primaryKey = 'ID_IDIOMA';
    public $timestamps = false;
     use TracksUserChanges;

    protected $fillable = [
        'IDIOMA',
        'created_by',  
        'updated_by',
        
    ];

    // Relación con TITULO
    public function titulos(): HasMany
    {
        return $this->hasMany(Titulo::class, 'ID_IDIOMA');
    }
}
