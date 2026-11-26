<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patio extends Model
{
    protected $table = 'patios';

    protected $fillable = [
        'nome',
        'localizacao',
        'capacidade',
        'ativo',
    ];

    protected $casts = [
        'capacidade' => 'decimal:2',
        'ativo' => 'boolean',
    ];
}
