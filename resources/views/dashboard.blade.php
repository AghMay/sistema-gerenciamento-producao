@extends('layouts.app')
@section('title','Dashboard | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Dashboard</h1><p>Visão geral da produção e movimentação de materiais</p></div><a class="btn btn-orange" href="{{ route('sodep.form') }}">↻ Integração SODEP</a></header>
<section class="stat-grid">
 <div class="stat-card"><small>Produção na data selecionada</small><strong>{{ number_format((float)$producaoDia,2,',','.') }} t</strong></div>
 <div class="stat-card"><small>Produção no mês de referência</small><strong>{{ number_format((float)$producaoMes,2,',','.') }} t</strong></div>
 <div class="stat-card"><small>Registros exibidos</small><strong>{{ $registros->count() }}</strong></div>
</section>
<section class="filter-panel"><h2>Filtros de consulta</h2>
<form method="GET" action="{{ route('dashboard') }}" class="row g-3 align-items-end">
 <div class="col-md-3"><label for="data">Data</label><input class="form-control" type="date" name="data" id="data" value="{{ $data }}"></div>
 <div class="col-md-3"><label for="litologia">Litologia</label><select class="form-select" name="litologia" id="litologia"><option value="">Todas</option>@foreach($litologias as $litologia)<option value="{{ $litologia }}" @selected(request('litologia')===$litologia)>{{ $litologia }}</option>@endforeach</select></div>
 <div class="col-md-3"><label for="origem_id">Origem</label><select class="form-select" name="origem_id" id="origem_id"><option value="">Todas</option>@foreach($origens as $origem)<option value="{{ $origem->id }}" @selected(request('origem_id')==$origem->id)>{{ $origem->nome }}</option>@endforeach</select></div>
 <div class="col-md-3"><button class="btn btn-dark-custom w-100">Pesquisar</button></div>
</form></section>
<section class="panel"><div class="panel-heading"><h2>Produções recentes</h2><a href="{{ route('producoes.index') }}" class="btn btn-sm btn-orange">Ver produção</a></div>
<div class="table-responsive"><table class="table"><thead><tr><th>Data</th><th>Material</th><th>Origem</th><th>Destino</th><th>Litologia</th><th>Quantidade</th></tr></thead><tbody>
@forelse($registros as $registro)<tr><td>{{ optional($registro->data_producao)->format('d/m/Y') ?? $registro->data_producao }}</td><td>{{ $registro->material->nome ?? $registro->tipo_material ?? '—' }}</td><td>{{ $registro->origem->nome ?? '—' }}</td><td>{{ $registro->destino->nome ?? '—' }}</td><td>{{ $registro->litologia ?? '—' }}</td><td>{{ number_format((float)$registro->quantidade,2,',','.') }} {{ $registro->unidade }}</td></tr>
@empty<tr><td colspan="6" class="empty-state">Nenhum registro encontrado para os filtros selecionados. Importe dados pela integração SODEP ou cadastre uma produção.</td></tr>@endforelse
</tbody></table></div></section>
@endsection
