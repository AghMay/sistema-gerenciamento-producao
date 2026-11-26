@extends('layouts.app')
@section('title','Novo pátio | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Novo pátio</h1><p>Informe os dados do local de armazenamento</p></div><a class="btn btn-dark-custom" href="{{ route('patios.index') }}">← Voltar</a></header>
<div class="form-card"><form method="POST" action="{{ route('patios.store') }}">@csrf 
<div class="row g-3"><div class="col-md-6"><label class="form-label">Nome *</label><input class="form-control" name="nome" required maxlength="255" value="{{ old('nome','') }}" placeholder="Ex.: Pátio Central"></div><div class="col-md-6"><label class="form-label">Localização</label><input class="form-control" name="localizacao" value="{{ old('localizacao','') }}" placeholder="Ex.: Mina Santa Cruz"></div><div class="col-md-6"><label class="form-label">Capacidade (toneladas)</label><input class="form-control" type="number" min="0.01" step="0.01" name="capacidade" value="{{ old('capacidade','') }}"></div><div class="col-md-6 d-flex align-items-end"><div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="ativo" value="1" id="ativo" @checked(old('ativo',true))><label class="form-check-label" for="ativo">Pátio ativo</label></div></div></div>
<div class="d-flex justify-content-end gap-2 mt-4"><a class="btn btn-light" href="{{ route('patios.index') }}">Cancelar</a><button class="btn btn-orange">Salvar pátio</button></div></form></div>
@endsection
