<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'ativo',
    ];

    public function producoes(): HasMany
    {
        return $this->hasMany(Producao::class);
    }

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class);
    }
}
