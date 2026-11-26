<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProducaoController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\PatioController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SodepController;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('producoes', ProducaoController::class);
Route::resource('movimentacoes', MovimentacaoController::class);
Route::resource('patios', PatioController::class);
Route::resource('materiais', MaterialController::class);

Route::get('/relatorios', function () {
    $porMaterial = \App\Models\Producao::query()
        ->join('materials','producaos.material_id','=','materials.id')
        ->selectRaw('materials.nome as material, SUM(producaos.quantidade) as total')
        ->groupBy('materials.nome')->orderByDesc('total')->get();
    $porOrigem = \App\Models\Producao::query()
        ->join('origens','producaos.origem_id','=','origens.id')
        ->selectRaw('origens.nome as origem, SUM(producaos.quantidade) as total')
        ->groupBy('origens.nome')->orderByDesc('total')->get();
    return view('relatorios.index', compact('porMaterial','porOrigem'));
})->name('relatorios');

Route::prefix('sodep')->name('sodep.')->group(function () {
    Route::get('/', [SodepController::class, 'form'])->name('form');
    Route::post('/testar', [SodepController::class, 'testar'])->name('testar');
    Route::post('/importar', [SodepController::class, 'importar'])->name('importar');
});

// Diagnóstico local do banco; remover ou proteger antes de publicar na internet.
Route::get('/teste-banco', function () {
    return response()->json([
        'database' => DB::connection()->getDatabaseName(),
        'materials' => Schema::hasTable('materials'),
        'producaos' => Schema::hasTable('producaos'),
        'patios' => Schema::hasTable('patios'),
        'movimentacaos' => Schema::hasTable('movimentacaos'),
    ]);
});
