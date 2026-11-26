@extends('layouts.app')
@section('title','Nova produção | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Nova produção</h1><p>Cadastro manual de produção</p></div><a class="btn btn-dark-custom" href="{{ route('producoes.index') }}">← Voltar</a></header>
<div class="form-card"><form method="POST" action="{{ route('producoes.store') }}">@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Material *</label><select class="form-select" name="material_id" required><option value="">Selecione</option>@foreach($materiais as $m)<option value="{{ $m->id }}" @selected(old('material_id')==$m->id)>{{ $m->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Origem *</label><select class="form-select" name="origem_id" required><option value="">Selecione</option>@foreach($origens as $o)<option value="{{ $o->id }}" @selected(old('origem_id')==$o->id)>{{ $o->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Destino</label><select class="form-select" name="destino_id"><option value="">Não informado</option>@foreach($destinos as $d)<option value="{{ $d->id }}" @selected(old('destino_id')==$d->id)>{{ $d->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Data *</label><input class="form-control" type="date" name="data_producao" required value="{{ old('data_producao',today()->toDateString()) }}"></div>
<div class="col-md-6"><label class="form-label">Quantidade *</label><input class="form-control" type="number" min="0.01" step="0.01" name="quantidade" required value="{{ old('quantidade') }}"></div>
<div class="col-md-6"><label class="form-label">Unidade *</label><select class="form-select" name="unidade" required><option value="t">Toneladas (t)</option><option value="kg">Quilogramas (kg)</option></select></div>
<div class="col-12"><label class="form-label">Observação</label><textarea class="form-control" rows="3" name="observacao">{{ old('observacao') }}</textarea></div>
</div><div class="d-flex justify-content-end gap-2 mt-4"><a class="btn btn-light" href="{{ route('producoes.index') }}">Cancelar</a><button class="btn btn-orange">Salvar produção</button></div></form></div>
@endsection
