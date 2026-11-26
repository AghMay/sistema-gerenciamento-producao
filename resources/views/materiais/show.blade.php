@extends('layouts.app')
@section('title','Detalhes do material | Mina Control')
@section('content')
<header class="page-heading"><div><h1>{{ $material->nome }}</h1><p>Detalhes do material</p></div><div class="d-flex gap-2"><a class="btn btn-outline-primary" href="{{ route('materiais.edit',$material) }}">Editar</a><a class="btn btn-dark-custom" href="{{ route('materiais.index') }}">Voltar</a></div></header>
<div class="form-card"><dl class="row mb-0"><dt class="col-sm-3">Tipo</dt><dd class="col-sm-9">{{ $material->tipo ?: '—' }}</dd><dt class="col-sm-3">Descrição</dt><dd class="col-sm-9">{{ $material->descricao ?: '—' }}</dd><dt class="col-sm-3">Situação</dt><dd class="col-sm-9">{{ $material->ativo?'Ativo':'Inativo' }}</dd></dl></div>
@endsection
