<?php

namespace App\Http\Controllers;

use App\Services\SodepService;
use App\Services\SodepImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SodepController extends Controller
{
    public function form(){return view('sodep.index');}

    public function testar(SodepService $service)
    {
        try {
            $service->login();
            return back()->with('success','Autenticação com SODEP realizada. Os tokens foram recebidos e não foram exibidos.');
        } catch (\Throwable $e) {
            Log::error('Falha no teste de autenticação SODEP', ['exception'=>$e]);
            return back()->with('error','Não foi possível autenticar no SODEP. Confira as variáveis MINETRACK_* no .env e o log do Laravel.');
        }
    }

    public function importar(Request $request, SodepImportService $service)
    {
        $dados=$request->validate([
            'data_inicio'=>'required|date',
            'data_fim'=>'required|date|after_or_equal:data_inicio',
        ]);
        try {
            $resultado=$service->importarPeriodo($dados['data_inicio'],$dados['data_fim']);
            return back()->with('importacao',$resultado)->with('success','Consulta ao SODEP concluída.');
        } catch (\Throwable $e) {
            Log::error('Falha na importação SODEP', ['exception'=>$e]);
            return back()->with('error','Falha ao importar. Verifique as configurações da API e os detalhes em storage/logs/laravel.log.');
        }
    }
}
