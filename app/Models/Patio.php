<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patio extends Model
{
    protected $fillable = [
        'nome',
        'localizacao',
        'capacidade',
        'ativo',
    ];

    public function movimentacoesOrigem(): HasMany
    {
        return $this->hasMany(
            Movimentacao::class,
            'patio_origem_id'
        );
    }

    public function movimentacoesDestino(): HasMany
    {
        return $this->hasMany(
            Movimentacao::class,
            'patio_destino_id'
        );
    }
}
