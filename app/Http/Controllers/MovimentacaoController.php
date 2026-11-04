<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Material;
use App\Models\Patio;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    /**
     * Exibe uma lista das movimentações.
     */
    public function index()
    {
        $movimentacoes = Movimentacao::with([
            'material',
            'patioOrigem',
            'patioDestino'
        ])->get();

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        $materiais = Material::where('ativo', true)->get();
        $patios = Patio::where('ativo', true)->get();

        return view('movimentacoes.create', compact(
            'materiais',
            'patios'
        ));
    }

    /**
     * Salva uma nova movimentação.
     */
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materiais,id',
            'patio_origem_id' => 'required|exists:patios,id',
            'patio_destino_id' => 'required|exists:patios,id|different:patio_origem_id',
            'quantidade' => 'required|numeric|min:0',
            'data_movimentacao' => 'required|date',
            'hora_movimentacao' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
        ]);

        Movimentacao::create($request->all());

        return redirect()
            ->route('movimentacoes.index')
            ->with('success', 'Movimentação cadastrada com sucesso!');
    }

    /**
     * Exibe uma movimentação específica.
     */
    public function show(Movimentacao $movimentacao)
    {
        $movimentacao->load([
            'material',
            'patioOrigem',
            'patioDestino'
        ]);

        return view(
            'movimentacoes.show',
            compact('movimentacao')
        );
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Movimentacao $movimentacao)
    {
        $materiais = Material::where('ativo', true)->get();
        $patios = Patio::where('ativo', true)->get();

        return view(
            'movimentacoes.edit',
            compact(
                'movimentacao',
                'materiais',
                'patios'
            )
        );
    }

    /**
     * Atualiza uma movimentação.
     */
    public function update(
        Request $request,
        Movimentacao $movimentacao
    ) {
        $request->validate([
            'material_id' => 'required|exists:materiais,id',
            'patio_origem_id' => 'required|exists:patios,id',
            'patio_destino_id' => 'required|exists:patios,id|different:patio_origem_id',
            'quantidade' => 'required|numeric|min:0',
            'data_movimentacao' => 'required|date',
            'hora_movimentacao' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
        ]);

        $movimentacao->update($request->all());

        return redirect()
            ->route('movimentacoes.index')
            ->with('success', 'Movimentação atualizada com sucesso!');
    }

    /**
     * Exclui uma movimentação.
     */
    public function destroy(Movimentacao $movimentacao)
    {
        $movimentacao->delete();

        return redirect()
            ->route('movimentacoes.index')
            ->with('success', 'Movimentação excluída com sucesso!');
    }
}
