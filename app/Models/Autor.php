<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksUserChanges;

class Autor extends Model
{
    protected $table = 'AUTOR';
    protected $primaryKey = 'ID_AUTOR';
    public $timestamps = true;
    use TracksUserChanges;
    protected $fillable = [
        'NOM_AUTOR',
        'APE_AUTOR',
        'DESC_AUTOR',
        'created_by',  
        'updated_by',
    ];

    public function titulos()
    {
        return $this->belongsToMany(Titulo::class, 'TITULO_AUTOR', 'ID_AUTOR', 'ID_TITULO');
    }


}
