<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    /**
     * Exibe uma lista de destinos.
     */
    public function index()
    {
        $destinos = Destino::all();

        return view('destinos.index', compact('destinos'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('destinos.create');
    }

    /**
     * Salva um novo destino.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Destino::create($request->all());

        return redirect()
            ->route('destinos.index')
            ->with('success', 'Destino cadastrado com sucesso!');
    }

    /**
     * Exibe um destino específico.
     */
    public function show(Destino $destino)
    {
        return view('destinos.show', compact('destino'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Destino $destino)
    {
        return view('destinos.edit', compact('destino'));
    }

    /**
     * Atualiza um destino.
     */
    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $destino->update($request->all());

        return redirect()
            ->route('destinos.index')
            ->with('success', 'Destino atualizado com sucesso!');
    }

    /**
     * Exclui um destino.
     */
    public function destroy(Destino $destino)
    {
        $destino->delete();

        return redirect()
            ->route('destinos.index')
            ->with('success', 'Destino excluído com sucesso!');
    }
}
