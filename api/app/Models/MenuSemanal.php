<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuSemanal extends Model
{
    protected $table = 'menus_semanales';

    protected $fillable = [
        'hogar_id',
        'semana_inicio',
        'estado',
        'generado_en',
        'aceptado_en',
    ];

    protected function casts(): array
    {
        return [
            'semana_inicio' => 'date',
            'generado_en'   => 'datetime',
            'aceptado_en'   => 'datetime',
        ];
    }

    public function hogar(): BelongsTo
    {
        return $this->belongsTo(Hogar::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(SlotMenu::class);
    }

    public function listaCompra(): HasOne
    {
        return $this->hasOne(ListaCompra::class);
    }
}
