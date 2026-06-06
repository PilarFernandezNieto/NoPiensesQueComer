<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaIngrediente extends Model
{
    protected $table = 'categorias_ingredientes';

    protected $fillable = ['nombre', 'orden'];

    public function ingredientes(): HasMany
    {
        return $this->hasMany(Ingrediente::class);
    }
}
