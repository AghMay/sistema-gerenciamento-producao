@extends('layouts.app')
@section('title','Editar movimentação | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Editar movimentação</h1><p>Registre a transferência de material entre dois pátios</p></div><a class="btn btn-dark-custom" href="{{ route('movimentacoes.index') }}">← Voltar</a></header>
<div class="form-card"><form method="POST" action="{{ $movimentacao ? route('movimentacoes.update',$movimentacao) : route('movimentacoes.store') }}">@csrf @if($movimentacao) @method('PUT') @endif
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Material *</label><select class="form-select" name="material_id" required><option value="">Selecione</option>@foreach($materiais as $material)<option value="{{ $material->id }}" @selected(old('material_id',$movimentacao->material_id ?? '')==$material->id)>{{ $material->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Quantidade (t) *</label><input class="form-control" type="number" name="quantidade" min="0.01" step="0.01" required value="{{ old('quantidade',$movimentacao->quantidade ?? '') }}"></div>
<div class="col-md-6"><label class="form-label">Pátio de origem *</label><select class="form-select" name="patio_origem_id" required><option value="">Selecione</option>@foreach($patios as $patio)<option value="{{ $patio->id }}" @selected(old('patio_origem_id',$movimentacao->patio_origem_id ?? '')==$patio->id)>{{ $patio->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Pátio de destino *</label><select class="form-select" name="patio_destino_id" required><option value="">Selecione</option>@foreach($patios as $patio)<option value="{{ $patio->id }}" @selected(old('patio_destino_id',$movimentacao->patio_destino_id ?? '')==$patio->id)>{{ $patio->nome }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Data *</label><input class="form-control" type="date" name="data_movimentacao" required value="{{ old('data_movimentacao',isset($movimentacao) ? \Carbon\Carbon::parse($movimentacao->data_movimentacao)->format('Y-m-d') : today()->toDateString()) }}"></div>
<div class="col-md-6"><label class="form-label">Hora</label><input class="form-control" type="time" name="hora_movimentacao" value="{{ old('hora_movimentacao',isset($movimentacao->hora_movimentacao) ? substr($movimentacao->hora_movimentacao,0,5) : now()->format('H:i')) }}"></div>
<div class="col-12"><label class="form-label">Observação</label><textarea class="form-control" rows="3" name="observacao">{{ old('observacao',$movimentacao->observacao ?? '') }}</textarea></div>
</div><div class="d-flex justify-content-end gap-2 mt-4"><a class="btn btn-light" href="{{ route('movimentacoes.index') }}">Cancelar</a><button class="btn btn-orange">Salvar movimentação</button></div></form></div>
@endsection
