<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receta extends Model
{
    protected $table = 'recetas';

    protected $fillable = ['hogar_id', 'nombre', 'preparacion', 'tiempo_prep_min', 'raciones', 'tipo_comida', 'apta_taper', 'apta_congelar', 'genera_sobras', 'raciones_sobra', 'es_sistema'];

    public function casts(): array
    {
        return [
            'apta_taper' => 'boolean',
            'apta_congelar' => 'boolean',
            'genera_sobras' => 'boolean',
            'es_sistema' => 'boolean',
        ];
    }

    public function hogar(): BelongsTo
    {
        return $this->belongsTo(Hogar::class);
    }

    public function ingredientes(): HasMany
    {
        return $this->hasMany(IngredienteReceta::class);
    }
    public function slotsMenu(): HasMany
    {
        return $this->hasMany(SlotMenu::class);
    }
}
