<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class SodepService
{
    /**
     * Faz login na API do Minetrack/SODEP.
     */
    public function login(): array
{
    $url = config('services.minetrack.login_url');

    $codigoAcesso = config('services.minetrack.codigo_acesso');

    $body = [
        'codigoAcesso' => $codigoAcesso,
    ];

    $response = Http::timeout(30)
        ->acceptJson()
        ->post($url, $body);

    if ($response->failed()) {
        throw new Exception(
            'Erro ao fazer login na API: HTTP '
            . $response->status()
            . ' - '
            . $response->body()
        );
    }

    $dados = $response->json();

    if (
        !isset($dados['token_cliente']) ||
        !isset($dados['token_portal'])
    ) {
        throw new Exception(
            'A API respondeu, mas os tokens de autenticação não foram encontrados.'
        );
    }

    return [
        'token_cliente' => $dados['token_cliente'],
        'token_portal' => $dados['token_portal'],
    ];
}

    /**
     * Busca a produção de um único dia.
     */
    public function buscarProducaoPorDia(
        string $data,
        array $tokens
    ): array {
        $url = config('services.minetrack.api_url');

        $response = Http::timeout(60)
            ->withHeaders([
                'Cliente' => $tokens['token_cliente'],
                'Authorization' => 'Bearer ' . $tokens['token_portal'],
                'Accept' => 'application/json',
            ])
            ->get(
                $url . '/api-bi/fato-producao/by-data-turno',
                [
                    'dateFilter' => $data,
                ]
            );

        // 204 = nenhum dado para aquele dia
        if ($response->status() === 204) {
            return [];
        }

        if ($response->failed()) {
            throw new Exception(
                'Erro ao consultar produção do dia '
                . $data
                . ': HTTP '
                . $response->status()
                . ' - '
                . $response->body()
            );
        }

        $dados = $response->json();

        if (!is_array($dados)) {
            return [];
        }

        return $dados;
    }

    public function buscarProducaoPeriodo(
        string $dataInicio,
        string $dataFim
    ): array {
        $tokens = $this->login();

        $inicio = new \DateTime($dataInicio);
        $fim = new \DateTime($dataFim);

        $todos = [];

        while ($inicio <= $fim) {

            $data = $inicio->format('Y-m-d');

            $dadosDoDia = $this->buscarProducaoPorDia(
                $data,
                $tokens
            );

            if (!empty($dadosDoDia)) {
                $todos = array_merge(
                    $todos,
                    $dadosDoDia
                );
            }

            $inicio->modify('+1 day');
        }

        return $todos;
    }
}
