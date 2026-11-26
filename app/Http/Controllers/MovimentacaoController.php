<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Material;
use App\Models\Patio;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimentacao::with(['material','patioOrigem','patioDestino']);
        if ($request->filled('data')) $query->whereDate('data_movimentacao', $request->data);
        if ($request->filled('material_id')) $query->where('material_id', $request->material_id);
        if ($request->filled('patio_id')) $query->where(fn($q) => $q->where('patio_origem_id',$request->patio_id)->orWhere('patio_destino_id',$request->patio_id));

        $movimentacoes = $query->orderByDesc('data_movimentacao')->orderByDesc('hora_movimentacao')->paginate(15)->withQueryString();
        $materiais = Material::where('ativo',true)->orderBy('nome')->get();
        $patios = Patio::where('ativo',true)->orderBy('nome')->get();
        $totalHoje = Movimentacao::whereDate('data_movimentacao',today())->sum('quantidade');
        $totalMes = Movimentacao::whereMonth('data_movimentacao',now()->month)->whereYear('data_movimentacao',now()->year)->sum('quantidade');
        $totalRegistros = Movimentacao::count();

        return view('movimentacoes.index', compact('movimentacoes','materiais','patios','totalHoje','totalMes','totalRegistros'));
    }

    public function create()
    {
        $materiais = Material::where('ativo',true)->orderBy('nome')->get();
        $patios = Patio::where('ativo',true)->orderBy('nome')->get();
        return view('movimentacoes.create',compact('materiais','patios'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'patio_origem_id' => 'required|exists:patios,id',
            'patio_destino_id' => 'required|exists:patios,id|different:patio_origem_id',
            'quantidade' => 'required|numeric|gt:0',
            'data_movimentacao' => 'required|date',
            'hora_movimentacao' => 'nullable|date_format:H:i',
            'observacao' => 'nullable|string|max:2000',
        ]);
        Movimentacao::create($dados);
        return redirect()->route('movimentacoes.index')->with('success','Movimentação cadastrada com sucesso.');
    }

    public function show(Movimentacao $movimentacao)
    {
        $movimentacao->load(['material','patioOrigem','patioDestino']);
        return view('movimentacoes.show',compact('movimentacao'));
    }

    public function edit(Movimentacao $movimentacao)
    {
        $materiais = Material::where('ativo',true)->orderBy('nome')->get();
        $patios = Patio::where('ativo',true)->orderBy('nome')->get();
        return view('movimentacoes.edit',compact('movimentacao','materiais','patios'));
    }

    public function update(Request $request, Movimentacao $movimentacao)
    {
        $dados = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'patio_origem_id' => 'required|exists:patios,id',
            'patio_destino_id' => 'required|exists:patios,id|different:patio_origem_id',
            'quantidade' => 'required|numeric|gt:0',
            'data_movimentacao' => 'required|date',
            'hora_movimentacao' => 'nullable|date_format:H:i',
            'observacao' => 'nullable|string|max:2000',
        ]);
        $movimentacao->update($dados);
        return redirect()->route('movimentacoes.index')->with('success','Movimentação atualizada com sucesso.');
    }

    public function destroy(Movimentacao $movimentacao)
    {
        $movimentacao->delete();
        return redirect()->route('movimentacoes.index')->with('success','Movimentação excluída com sucesso.');
    }
}
