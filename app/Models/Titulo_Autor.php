<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\TracksUserChanges;

class Titulo_Autor extends Model
{
    protected $table = 'TITULO_AUTOR';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
    use TracksUserChanges;

    protected $fillable = [
        'ID_TITULO',
        'ID_AUTOR',
        'created_by',  
        'updated_by',
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
