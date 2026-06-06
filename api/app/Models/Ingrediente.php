<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingrediente extends Model
{
    protected $table = 'ingredientes';

    protected $fillable = ['categoria_id', 'nombre', 'slug', 'es_sistema'];

    public function casts(): array
    {
        return [
            'es_sistema' => 'boolean'
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaIngrediente::class, 'catgoria_id');
    }

    public function restricciones(): HasMany
    {
        return $this->hasMany(RestriccionIngrediente::class);
    }
    public function recetas(): HasMany
    {
        return $this->hasMany(IngredienteReceta::class);
    }
}
