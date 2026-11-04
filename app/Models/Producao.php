<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producao extends Model
{
    protected $fillable = [

        // Relacionamentos do nosso sistema
        'material_id',
        'origem_id',
        'destino_id',

        // Dados principais da produção
        'data_producao',
        'quantidade',
        'unidade',
        'observacao',

        // Identificação do registro no SODEP
        'sodep_id',
        'cod_viagem',

        // Dados provenientes do SODEP
        'equipamento',
        'operador',
        'turno',
        'litologia',
        'mina',
        'tipo_material',
        'sodep_data_registro',
    ];

    protected $casts = [
        'data_producao' => 'date',
        'sodep_data_registro' => 'datetime',
        'quantidade' => 'decimal:2',
    ];

    /**
     * Material da produção.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Origem da produção.
     */
    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class);
    }

    /**
     * Destino da produção.
     */
    public function destino(): BelongsTo
    {
        return $this->belongsTo(Destino::class);
    }
}
