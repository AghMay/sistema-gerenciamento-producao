<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query();
        if ($request->filled('busca')) $query->where('nome','like','%'.$request->busca.'%');
        if ($request->filled('status')) $query->where('ativo',$request->status === '1');
        $materiais = $query->orderBy('nome')->paginate(15)->withQueryString();
        return view('materiais.index',compact('materiais'));
    }
    public function create(){return view('materiais.create');}
    public function store(Request $request)
    {
        $dados=$request->validate(['nome'=>'required|string|max:255','tipo'=>'nullable|string|max:255','descricao'=>'nullable|string|max:2000']);
        $dados['ativo']=$request->boolean('ativo');
        Material::create($dados);
        return redirect()->route('materiais.index')->with('success','Material cadastrado com sucesso.');
    }
    public function show(Material $material){return view('materiais.show',compact('material'));}
    public function edit(Material $material){return view('materiais.edit',compact('material'));}
    public function update(Request $request,Material $material)
    {
        $dados=$request->validate(['nome'=>'required|string|max:255','tipo'=>'nullable|string|max:255','descricao'=>'nullable|string|max:2000']);
        $dados['ativo']=$request->boolean('ativo');$material->update($dados);
        return redirect()->route('materiais.index')->with('success','Material atualizado com sucesso.');
    }
    public function destroy(Material $material)
    {
        try{$material->delete();}catch(\Illuminate\Database\QueryException $e){return back()->with('error','Este material possui registros vinculados e não pode ser excluído. Desative-o.');}
        return redirect()->route('materiais.index')->with('success','Material excluído com sucesso.');
    }
}
