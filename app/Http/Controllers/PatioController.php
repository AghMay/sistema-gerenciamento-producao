<?php

namespace App\Http\Controllers;

use App\Models\Patio;
use Illuminate\Http\Request;

class PatioController extends Controller
{
    public function index(Request $request)
    {
        $query = Patio::query();
        if ($request->filled('busca')) $query->where('nome', 'like', '%'.$request->busca.'%');
        if ($request->filled('status')) $query->where('ativo', $request->status === '1');

        $patios = $query->orderBy('nome')->paginate(15)->withQueryString();
        $totalPatios = Patio::count();
        $patiosAtivos = Patio::where('ativo', true)->count();
        $patiosInativos = Patio::where('ativo', false)->count();

        return view('patios.index', compact('patios','totalPatios','patiosAtivos','patiosInativos'));
    }

    public function create() { return view('patios.create'); }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'nullable|string|max:255',
            'capacidade' => 'nullable|numeric|gt:0',
        ]);
        $dados['ativo'] = $request->boolean('ativo');
        Patio::create($dados);
        return redirect()->route('patios.index')->with('success','Pátio cadastrado com sucesso.');
    }

    public function show(Patio $patio) { return view('patios.show', compact('patio')); }
    public function edit(Patio $patio) { return view('patios.edit', compact('patio')); }

    public function update(Request $request, Patio $patio)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'nullable|string|max:255',
            'capacidade' => 'nullable|numeric|gt:0',
        ]);
        $dados['ativo'] = $request->boolean('ativo');
        $patio->update($dados);
        return redirect()->route('patios.index')->with('success','Pátio atualizado com sucesso.');
    }

    public function destroy(Patio $patio)
    {
        try { $patio->delete(); }
        catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error','Não é possível excluir este pátio porque existem movimentações vinculadas a ele. Desative-o em vez disso.');
        }
        return redirect()->route('patios.index')->with('success','Pátio excluído com sucesso.');
    }
}
