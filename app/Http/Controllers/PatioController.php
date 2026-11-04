<?php

namespace App\Http\Controllers;

use App\Models\Patio;
use Illuminate\Http\Request;

class PatioController extends Controller
{
    /**
     * Exibe uma lista dos pátios.
     */
    public function index()
    {
        $patios = Patio::all();

        return view('patios.index', compact('patios'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('patios.create');
    }

    /**
     * Salva um novo pátio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'capacidade' => 'required|numeric|min:0',
            'ativo' => 'boolean',
        ]);

        Patio::create($request->all());

        return redirect()
            ->route('patios.index')
            ->with('success', 'Pátio cadastrado com sucesso!');
    }

    /**
     * Exibe um pátio específico.
     */
    public function show(Patio $patio)
    {
        return view('patios.show', compact('patio'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Patio $patio)
    {
        return view('patios.edit', compact('patio'));
    }

    /**
     * Atualiza um pátio.
     */
    public function update(Request $request, Patio $patio)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'localizacao' => 'required|string|max:255',
            'capacidade' => 'required|numeric|min:0',
            'ativo' => 'boolean',
        ]);

        $patio->update($request->all());

        return redirect()
            ->route('patios.index')
            ->with('success', 'Pátio atualizado com sucesso!');
    }

    /**
     * Exclui um pátio.
     */
    public function destroy(Patio $patio)
    {
        $patio->delete();

        return redirect()
            ->route('patios.index')
            ->with('success', 'Pátio excluído com sucesso!');
    }
}
