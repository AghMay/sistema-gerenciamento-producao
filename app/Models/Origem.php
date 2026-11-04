<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Origem extends Model
{
    protected $table = 'origens';

    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'ativo',
    ];
}
