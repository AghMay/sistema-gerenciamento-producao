<?php

namespace App\Http\Controllers;

use App\Models\Producao;
use App\Models\Material;
use App\Models\Origem;
use App\Models\Destino;
use Illuminate\Http\Request;

class ProducaoController extends Controller
{
    /**
     * Exibe uma lista das produções.
     */
    public function index(Request $request)
{
    // =====================================================
    // DATA DE REFERÊNCIA
    // =====================================================

    // Se o usuário escolher uma data no filtro,
    // usamos essa data como referência dos indicadores.
    //
    // Se não escolher nenhuma data,
    // usamos a data atual.

    $dataReferencia = $request->filled('data')
        ? $request->data
        : now()->toDateString();


    // =====================================================
    // QUERY PRINCIPAL DA TABELA
    // =====================================================

    $query = Producao::with([
        'material',
        'origem',
        'destino'
    ]);


    // =====================================================
    // FILTRO POR DATA
    // =====================================================

    if ($request->filled('data')) {

        $query->whereDate(
            'data_producao',
            $request->data
        );
    }


    // =====================================================
    // FILTRO POR LITOLOGIA
    // =====================================================

    if ($request->filled('litologia')) {

        $query->where(
            'litologia',
            $request->litologia
        );
    }


    // =====================================================
    // FILTRO POR ORIGEM
    // =====================================================

    if ($request->filled('origem_id')) {

        $query->where(
            'origem_id',
            $request->origem_id
        );
    }


    // =====================================================
    // PRODUÇÃO DO DIA SELECIONADO
    // =====================================================

    $producaoHoje = Producao::whereDate(
        'data_producao',
        $dataReferencia
    )->sum('quantidade');


    // =====================================================
    // PRODUÇÃO DO MÊS DA DATA SELECIONADA
    // =====================================================

    $data = \Carbon\Carbon::parse($dataReferencia);

    $producaoMes = Producao::whereYear(
        'data_producao',
        $data->year
    )
    ->whereMonth(
        'data_producao',
        $data->month
    )
    ->sum('quantidade');


    // =====================================================
    // TOTAL DE REGISTROS FILTRADOS
    // =====================================================

    $totalRegistros = (clone $query)->count();


    // =====================================================
    // LISTAGEM
    // =====================================================

    $producoes = $query
        ->orderBy(
            'data_producao',
            'desc'
        )
        ->orderBy(
            'id',
            'desc'
        )
        ->paginate(20);


    // =====================================================
    // LITOLOGIAS
    // =====================================================

    $litologias = Producao::query()
        ->whereNotNull('litologia')
        ->where(
            'litologia',
            '!=',
            ''
        )
        ->distinct()
        ->orderBy('litologia')
        ->pluck('litologia');


    // =====================================================
    // ORIGENS
    // =====================================================

    $origens = Origem::where(
        'ativo',
        true
    )
    ->orderBy('nome')
    ->get();


    // =====================================================
    // VIEW
    // =====================================================

    return view(
        'producoes.index',
        compact(
            'producoes',
            'producaoHoje',
            'producaoMes',
            'totalRegistros',
            'litologias',
            'origens'
        )
    );
}

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        $materiais = Material::where('ativo', true)->get();

        $origens = Origem::where('ativo', true)->get();

        $destinos = Destino::where('ativo', true)->get();

        return view(
            'producoes.create',
            compact(
                'materiais',
                'origens',
                'destinos'
            )
        );
    }

    /**
     * Salva uma nova produção.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'origem_id' => 'required|exists:origens,id',
            'destino_id' => 'nullable|exists:destinos,id',
            'data_producao' => 'required|date',
            'quantidade' => 'required|numeric|min:0',
            'unidade' => 'required|string|max:50',
            'observacao' => 'nullable|string',
        ]);

        Producao::create($dados);

        return redirect()
            ->route('producoes.index')
            ->with(
                'success',
                'Produção cadastrada com sucesso!'
            );
    }

    /**
     * Exibe uma produção específica.
     */
    public function show(Producao $producao)
    {
        $producao->load([
            'material',
            'origem',
            'destino'
        ]);

        return view(
            'producoes.show',
            compact('producao')
        );
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Producao $producao)
    {
        $materiais = Material::where('ativo', true)->get();

        $origens = Origem::where('ativo', true)->get();

        $destinos = Destino::where('ativo', true)->get();

        return view(
            'producoes.edit',
            compact(
                'producao',
                'materiais',
                'origens',
                'destinos'
            )
        );
    }

    /**
     * Atualiza uma produção.
     */
    public function update(
        Request $request,
        Producao $producao
    ) {
        $dados = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'origem_id' => 'required|exists:origens,id',
            'destino_id' => 'nullable|exists:destinos,id',
            'data_producao' => 'required|date',
            'quantidade' => 'required|numeric|min:0',
            'unidade' => 'required|string|max:50',
            'observacao' => 'nullable|string',
        ]);

        $producao->update($dados);

        return redirect()
            ->route('producoes.index')
            ->with(
                'success',
                'Produção atualizada com sucesso!'
            );
    }

    /**
     * Exclui uma produção.
     */
    public function destroy(Producao $producao)
    {
        $producao->delete();

        return redirect()
            ->route('producoes.index')
            ->with(
                'success',
                'Produção excluída com sucesso!'
            );
    }
}
