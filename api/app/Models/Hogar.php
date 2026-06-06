<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hogar extends Model
{
    protected $table = 'hogares';

    protected $fillable = ['nombre'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function recetas(): HasMany
    {
        return $this->hasMany(Receta::class);
    }

    public function restriccionesIngredientes(): HasMany
    {
        return $this->hasMany(RestriccionIngrediente::class);
    }

    public function reglasHogar(): HasMany
    {
        return $this->hasMany(ReglaHogar::class);
    }
    public function menusSemanales(): HasMany
    {
        return $this->hasMany(MenuSemanal::class);
    }
}
