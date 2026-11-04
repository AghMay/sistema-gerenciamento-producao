<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacao extends Model
{
    protected $fillable = [
        'material_id',
        'patio_origem_id',
        'patio_destino_id',
        'quantidade',
        'data_movimentacao',
        'hora_movimentacao',
        'observacao',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function patioOrigem(): BelongsTo
    {
        return $this->belongsTo(Patio::class, 'patio_origem_id');
    }

    public function patioDestino(): BelongsTo
    {
        return $this->belongsTo(Patio::class, 'patio_destino_id');
    }
}
