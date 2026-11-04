<?php

namespace App\Http\Controllers;

use App\Models\Origem;
use Illuminate\Http\Request;

class OrigemController extends Controller
{
    /**
     * Exibe uma lista de origens.
     */
    public function index()
    {
        $origens = Origem::all();

        return view('origens.index', compact('origens'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('origens.create');
    }

    /**
     * Salva uma nova origem.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Origem::create($request->all());

        return redirect()
            ->route('origens.index')
            ->with('success', 'Origem cadastrada com sucesso!');
    }

    /**
     * Exibe uma origem específica.
     */
    public function show(Origem $origem)
    {
        return view('origens.show', compact('origem'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Origem $origem)
    {
        return view('origens.edit', compact('origem'));
    }

    /**
     * Atualiza uma origem.
     */
    public function update(Request $request, Origem $origem)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $origem->update($request->all());

        return redirect()
            ->route('origens.index')
            ->with('success', 'Origem atualizada com sucesso!');
    }

    /**
     * Exclui uma origem.
     */
    public function destroy(Origem $origem)
    {
        $origem->delete();

        return redirect()
            ->route('origens.index')
            ->with('success', 'Origem excluída com sucesso!');
    }
}
