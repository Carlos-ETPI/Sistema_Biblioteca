<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    protected $table = 'ROL';
    protected $primaryKey = 'ID_ROL';
    public $timestamps = false;

    protected $fillable = [
        'DESC_ROL',
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'ID_ROL');
    }
}
