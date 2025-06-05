<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'AUTOR';
    protected $primaryKey = 'ID_AUTOR';
    public $timestamps = false;

    protected $fillable = [
        'NOM_AUTOR',
        'APE_AUTOR',
        'DESC_AUTOR',
    ];

    public function titulos()
    {
        return $this->belongsToMany(Titulo::class, 'TITULO_AUTOR', 'ID_AUTOR', 'ID_TITULO');
    }


}
