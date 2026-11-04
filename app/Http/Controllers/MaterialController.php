<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Exibe a lista de materiais.
     */
    public function index()
    {
        $materiais = Material::all();

        return view('materiais.index', compact('materiais'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('materiais.create');
    }

    /**
     * Salva um novo material.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Material::create($request->all());

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material cadastrado com sucesso!');
    }

    /**
     * Exibe um material específico.
     */
public function show($id)
{
    $material = Material::findOrFail($id);

    return view('materiais.show', compact('material'));
}

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    /**
     * Atualiza um material.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $material->update($request->all());

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material atualizado com sucesso!');
    }

    /**
     * Exclui um material.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materiais.index')
            ->with('success', 'Material excluído com sucesso!');
    }
}
