<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SlotMenu extends Model
{
    protected $table = 'slots_menu';

    protected $fillable = [
        'menu_semanal_id',
        'receta_id',
        'dia_semana',
        'tipo_comida',
        'es_sobra',
        'slot_origen_id',
        'bloqueado',
        'raciones',
    ];

    protected function casts(): array
    {
        return [
            'dia_semana' => 'integer',
            'es_sobra'   => 'boolean',
            'bloqueado'  => 'boolean',
        ];
    }

    public function menuSemanal(): BelongsTo
    {
        return $this->belongsTo(MenuSemanal::class);
    }

    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class);
    }

    public function slotOrigen(): BelongsTo
    {
        return $this->belongsTo(SlotMenu::class, 'slot_origen_id');
    }

    public function sobras(): HasMany
    {
        return $this->hasMany(SlotMenu::class, 'slot_origen_id');
    }
}
