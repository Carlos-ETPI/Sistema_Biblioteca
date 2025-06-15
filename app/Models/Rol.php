<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\TracksUserChanges;

class Rol extends Model
{
    protected $table = 'ROL';
    protected $primaryKey = 'ID_ROL';
    public $timestamps = false;
    use TracksUserChanges;

    protected $fillable = [
        'DESC_ROL',
        'created_by',  
        'updated_by',
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'ID_ROL');
    }
}
