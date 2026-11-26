@extends('layouts.app')
@section('title','Novo material | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Novo material</h1><p>Preencha as informações do material</p></div><a class="btn btn-dark-custom" href="{{ route('materiais.index') }}">← Voltar</a></header>
<div class="form-card"><form method="POST" action="{{ route('materiais.store') }}">@csrf 
<div class="row g-3"><div class="col-md-6"><label class="form-label">Nome *</label><input class="form-control" name="nome" required value="{{ old('nome','') }}"></div><div class="col-md-6"><label class="form-label">Tipo</label><input class="form-control" name="tipo" value="{{ old('tipo','') }}" placeholder="Ex.: ROM, minério beneficiado"></div><div class="col-12"><label class="form-label">Descrição</label><textarea class="form-control" name="descricao" rows="3">{{ old('descricao','') }}</textarea></div><div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" name="ativo" value="1" id="ativo" @checked(old('ativo',true))><label class="form-check-label" for="ativo">Material ativo</label></div></div></div>
<div class="d-flex justify-content-end gap-2 mt-4"><a class="btn btn-light" href="{{ route('materiais.index') }}">Cancelar</a><button class="btn btn-orange">Salvar material</button></div></form></div>
@endsection
