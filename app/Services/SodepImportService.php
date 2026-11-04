<?php

namespace App\Services;

use App\Models\Producao;
use Illuminate\Support\Facades\DB;
use Exception;

class SodepImportService
{
    public function __construct(
        protected SodepService $sodepService
    ) {
    }

    /**
     * ==========================================================
     * IMPORTAR PRIMEIRO REGISTRO
     * ==========================================================
     *
     * Mantemos este método para testes.
     */
    public function importarPrimeiroRegistro(string $data): Producao
    {
        $dados = $this->sodepService->buscarProducaoPeriodo(
            $data,
            $data
        );

        if (empty($dados)) {
            throw new Exception(
                "Nenhum registro encontrado no SODEP para {$data}."
            );
        }

        return $this->importarRegistro($dados[0], $data);
    }

    /**
     * ==========================================================
     * IMPORTAR PERÍODO COMPLETO
     * ==========================================================
     *
     * Busca todos os registros do SODEP no período informado
     * e importa somente os registros que ainda não existem.
     */
    public function importarPeriodo(
        string $dataInicio,
        string $dataFim
    ): array {

        // ==========================================================
        // BUSCAR DADOS DO SODEP
        // ==========================================================

        $dados = $this->sodepService->buscarProducaoPeriodo(
            $dataInicio,
            $dataFim
        );

        if (empty($dados)) {
            return [
                'sucesso' => true,
                'data_inicio' => $dataInicio,
                'data_fim' => $dataFim,
                'total_encontrados' => 0,
                'novos_importados' => 0,
                'ja_existentes' => 0,
                'erros' => 0,
                'mensagem' => 'Nenhum registro encontrado no SODEP.',
            ];
        }

        $totalEncontrados = count($dados);
        $novosImportados = 0;
        $jaExistentes = 0;
        $erros = 0;
        $detalhesErros = [];

        // ==========================================================
        // PROCESSAR CADA REGISTRO
        // ==========================================================

        foreach ($dados as $registro) {

            try {

                $sodepId = $registro['idFatoProducao'] ?? null;

                if (!$sodepId) {
                    $erros++;

                    $detalhesErros[] = [
                        'erro' => 'Registro sem idFatoProducao.',
                        'registro' => $registro,
                    ];

                    continue;
                }

                // ==================================================
                // VERIFICAR DUPLICIDADE
                // ==================================================

                $existente = Producao::where(
                    'sodep_id',
                    $sodepId
                )->exists();

                if ($existente) {
                    $jaExistentes++;
                    continue;
                }

                // ==================================================
                // IMPORTAR REGISTRO
                // ==================================================

                $this->importarRegistro(
                    $registro,
                    $registro['dtRegistroIni']
                        ?? $dataInicio
                );

                $novosImportados++;

            } catch (\Throwable $e) {

                $erros++;

                $detalhesErros[] = [
                    'sodep_id' =>
                        $registro['idFatoProducao']
                        ?? null,

                    'erro' => $e->getMessage(),
                ];
            }
        }

        // ==========================================================
        // RETORNO
        // ==========================================================

        return [
            'sucesso' => true,

            'data_inicio' => $dataInicio,

            'data_fim' => $dataFim,

            'total_encontrados' => $totalEncontrados,

            'novos_importados' => $novosImportados,

            'ja_existentes' => $jaExistentes,

            'erros' => $erros,

            'detalhes_erros' => $detalhesErros,
        ];
    }

    /**
     * ==========================================================
     * IMPORTAR UM REGISTRO
     * ==========================================================
     *
     * Centralizamos aqui a transformação dos dados do SODEP
     * para o formato do nosso banco.
     */
    private function importarRegistro(
        array $registro,
        string $data
    ): Producao {

        // ==========================================================
        // ID DO SODEP
        // ==========================================================

        $sodepId = $registro['idFatoProducao'] ?? null;

        if (!$sodepId) {
            throw new Exception(
                'O registro retornado pelo SODEP não possui idFatoProducao.'
            );
        }

        // ==========================================================
        // MATERIAL
        // ==========================================================

        $nomeMaterial =
            $registro['nomeTipoMaterial']
            ?? 'Não informado';

        $materialId = DB::table('materials')
            ->where('nome', $nomeMaterial)
            ->value('id');

        if (!$materialId) {

            $materialId = DB::table('materials')->insertGetId([

                'nome' => $nomeMaterial,

                'descricao' =>
                    'Cadastrado automaticamente pelo SODEP',

                'tipo' => 'SODEP',

                'ativo' => true,

                'created_at' => now(),

                'updated_at' => now(),
            ]);
        }

        // ==========================================================
        // ORIGEM
        // ==========================================================

        $nomeOrigem =
            $registro['nomeOrigem']
            ?? 'Não informado';

        $origemId = DB::table('origens')
            ->where('nome', $nomeOrigem)
            ->value('id');

        if (!$origemId) {

            $origemId = DB::table('origens')->insertGetId([

                'nome' => $nomeOrigem,

                'tipo' => 'SODEP',

                'descricao' =>
                    'Cadastrado automaticamente pelo SODEP',

                'ativo' => true,

                'created_at' => now(),

                'updated_at' => now(),
            ]);
        }

        // ==========================================================
        // DESTINO
        // ==========================================================

        $destinoId = null;

        $nomeDestino =
            $registro['nomeDestino']
            ?? null;

        if (!empty($nomeDestino)) {

            $destinoId = DB::table('destinos')
                ->where('nome', $nomeDestino)
                ->value('id');

            if (!$destinoId) {

                $destinoId = DB::table('destinos')->insertGetId([

                    'nome' => $nomeDestino,

                    'tipo' => 'SODEP',

                    'descricao' =>
                        'Cadastrado automaticamente pelo SODEP',

                    'ativo' => true,

                    'created_at' => now(),

                    'updated_at' => now(),
                ]);
            }
        }

        // ==========================================================
        // DATA DA PRODUÇÃO
        // ==========================================================

        $dataProducao = $data;

        // ==========================================================
        // MASSA
        // ==========================================================

        $quantidade = isset($registro['massa'])
            ? (float) $registro['massa']
            : 0;

        // ==========================================================
        // CRIAR PRODUÇÃO
        // ==========================================================

        return Producao::create([

            // Relacionamentos
            'material_id' => $materialId,

            'origem_id' => $origemId,

            'destino_id' => $destinoId,

            // Dados principais
            'data_producao' => $dataProducao,

            'quantidade' => $quantidade,

            'unidade' => 't',

            'observacao' =>
                'Importado automaticamente do SODEP',

            // Identificação SODEP
            'sodep_id' => $sodepId,

            'cod_viagem' =>
                $registro['codViagem'] ?? null,

            // Dados SODEP
            'equipamento' =>
                $registro['nomeEquipamento'] ?? null,

            'operador' =>
                $registro['nomeOperador'] ?? null,

            'turno' =>
                $registro['nomeTurno'] ?? null,

            'litologia' =>
                $registro['nomeLitologia'] ?? null,

            'mina' =>
                $registro['nomeMina'] ?? null,

            'tipo_material' =>
                $registro['nomeTipoMaterial'] ?? null,

            'sodep_data_registro' =>
                $registro['dtRegistroIni'] ?? null,
        ]);
    }
}
