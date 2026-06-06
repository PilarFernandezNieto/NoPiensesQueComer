<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReglaHogar extends Model
{
    protected $table = 'reglas_hogar';

    protected $fillable = ['hogar_id', 'tipo', 'dia_semana', 'valor', 'notas'];

    protected function casts(): array
    {
        return [
            'dia_semana' => 'integer',
        ];
    }

    public function hogar(): BelongsTo
    {
        return $this->belongsTo(Hogar::class);
    }
}
