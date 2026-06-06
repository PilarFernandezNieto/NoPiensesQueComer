<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListaCompra extends Model
{
    protected $table = 'listas_compra';

    protected $fillable = [
        'menu_semanal_id',
        'generado_en',
    ];

    protected function casts(): array
    {
        return [
            'generado_en' => 'datetime',
        ];
    }

    public function menuSemanal(): BelongsTo
    {
        return $this->belongsTo(MenuSemanal::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemListaCompra::class);
    }
}
