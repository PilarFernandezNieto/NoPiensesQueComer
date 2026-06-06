<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngredienteReceta extends Model
{
    protected $table = 'ingredientes_receta';

    protected $fillable = ['receta_id', 'ingrediente_id', 'cantidad', 'unidad', 'notas'];

    public function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',

        ];
    }

    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
