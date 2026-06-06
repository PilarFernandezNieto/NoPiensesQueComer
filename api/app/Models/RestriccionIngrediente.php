<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestriccionIngrediente extends Model
{
    protected $table = 'restricciones_ingredientes';

    protected $fillable = ['hogar_id', 'ingrediente_id', 'ambito', 'notas'];

    public function hogar(): BelongsTo
    {
        return $this->belongsTo(Hogar::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
