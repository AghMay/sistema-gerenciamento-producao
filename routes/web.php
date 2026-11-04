<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProducaoController;

Route::get('/teste-banco', function () {
    return response()->json([
        'database' => DB::connection()->getDatabaseName(),
        'origens_existe' => Schema::hasTable('origens'),
        'origems_existe' => Schema::hasTable('origems'),
        'quantidade_origens' => Schema::hasTable('origens')
            ? DB::table('origens')->count()
            : null,
    ]);
});

Route::resource('producoes', ProducaoController::class);

// TESTE DE CONEXÃO COM SODEP
Route::get('/teste-login-sodep', function () {

    try {

        $sodep = app(\App\Services\SodepService::class);

        $tokens = $sodep->login();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Autenticação com SODEP realizada!',
            'token_cliente_recebido' => !empty($tokens['token_cliente']),
            'token_portal_recebido' => !empty($tokens['token_portal']),
        ]);

    } catch (\Throwable $e) {

        \Log::error('Erro no teste de login SODEP: ' . $e->getMessage());

        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Não foi possível autenticar no SODEP. Consulte o log do Laravel.',
        ], 500);
    }

});

// TESTE DE CONSULTA DE PRODUÇÃO NO SODEP
Route::get('/teste-producao-sodep/{data}', function ($data) {

    try {

        $sodep = app(\App\Services\SodepService::class);

        $dados = $sodep->buscarProducaoPeriodo($data, $data);

        return response()->json([
            'sucesso' => true,
            'data_consultada' => $data,
            'total_registros' => count($dados),
            'primeiro_registro' => $dados[0] ?? null,
        ]);

    } catch (\Throwable $e) {

        \Log::error('Erro na consulta de produção SODEP: ' . $e->getMessage());

        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Erro ao consultar produção. Verifique o log do Laravel.',
        ], 500);
    }

});
