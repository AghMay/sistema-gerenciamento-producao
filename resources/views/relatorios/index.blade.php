@extends('layouts.app')
@section('title','Relatórios | Mina Control')
@section('content')
<header class="page-heading"><div><h1>Relatórios</h1><p>Consolidação dos dados registrados no sistema</p></div><a class="btn btn-outline-dark" href="{{ route('producoes.index') }}">Ver produção</a></header>
<div class="row g-4"><div class="col-lg-6"><section class="panel"><div class="panel-heading"><h2>Produção por material</h2></div><div class="table-responsive"><table class="table"><thead><tr><th>Material</th><th>Total (t)</th></tr></thead><tbody>@forelse($porMaterial as $linha)<tr><td>{{ $linha->material }}</td><td>{{ number_format((float)$linha->total,2,',','.') }}</td></tr>@empty<tr><td colspan="2" class="empty-state">Sem dados de produção.</td></tr>@endforelse</tbody></table></div></section></div>
<div class="col-lg-6"><section class="panel"><div class="panel-heading"><h2>Produção por origem</h2></div><div class="table-responsive"><table class="table"><thead><tr><th>Origem</th><th>Total (t)</th></tr></thead><tbody>@forelse($porOrigem as $linha)<tr><td>{{ $linha->origem }}</td><td>{{ number_format((float)$linha->total,2,',','.') }}</td></tr>@empty<tr><td colspan="2" class="empty-state">Sem dados de produção.</td></tr>@endforelse</tbody></table></div></section></div></div>
@endsection
