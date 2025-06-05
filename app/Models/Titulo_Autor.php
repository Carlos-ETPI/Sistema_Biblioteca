<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Titulo_Autor extends Model
{
    protected $table = 'TITULO_AUTOR';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'ID_TITULO',
        'ID_AUTOR',
    ];

    public function titulo(): BelongsTo
    {
        return $this->belongsTo(Titulo::class, 'ID_TITULO');
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'ID_AUTOR');
    }
}
