<?php

namespace App\Http\Controllers;

use App\Models\Producao;
use App\Models\Patio;
use App\Models\Material;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->input('data', today()->toDateString());
        $referencia = \Carbon\Carbon::parse($data);

        $producaoDia = Producao::whereDate('data_producao', $data)->sum('quantidade');
        $producaoMes = Producao::whereYear('data_producao', $referencia->year)
            ->whereMonth('data_producao', $referencia->month)->sum('quantidade');

        $query = Producao::with(['material', 'origem', 'destino'])
            ->whereDate('data_producao', $data);

        if ($request->filled('litologia')) $query->where('litologia', $request->litologia);
        if ($request->filled('origem_id')) $query->where('origem_id', $request->origem_id);

        $registros = $query->latest('data_producao')->latest('id')->limit(12)->get();
        $litologias = Producao::whereNotNull('litologia')->where('litologia', '<>', '')
            ->distinct()->orderBy('litologia')->pluck('litologia');
        $origens = \App\Models\Origem::where('ativo', true)->orderBy('nome')->get();

        return view('dashboard', compact('data', 'producaoDia', 'producaoMes', 'registros', 'litologias', 'origens'));
    }
}
