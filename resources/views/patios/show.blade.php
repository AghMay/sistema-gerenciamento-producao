@extends('layouts.app')
@section('title','Detalhes do pátio | Mina Control')
@section('content')
<header class="page-heading"><div><h1>{{ $patio->nome }}</h1><p>Detalhes do pátio cadastrado</p></div><div class="d-flex gap-2"><a class="btn btn-outline-primary" href="{{ route('patios.edit',$patio) }}">Editar</a><a class="btn btn-dark-custom" href="{{ route('patios.index') }}">Voltar</a></div></header>
<div class="form-card"><dl class="row mb-0"><dt class="col-sm-3">Localização</dt><dd class="col-sm-9">{{ $patio->localizacao ?: 'Não informada' }}</dd><dt class="col-sm-3">Capacidade</dt><dd class="col-sm-9">{{ $patio->capacidade!==null ? number_format((float)$patio->capacidade,2,',','.') .' t' : 'Não informada' }}</dd><dt class="col-sm-3">Situação</dt><dd class="col-sm-9">{{ $patio->ativo?'Ativo':'Inativo' }}</dd><dt class="col-sm-3">Criado em</dt><dd class="col-sm-9">{{ $patio->created_at?->format('d/m/Y H:i') }}</dd></dl></div>
@endsection
