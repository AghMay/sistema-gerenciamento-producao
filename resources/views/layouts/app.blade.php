<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Mina Control')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--orange:#ed8d2e;--orange-dark:#d97819;--black:#111;--bg:#f3f4f6;--muted:#6b7280}
*{box-sizing:border-box}body{margin:0;background:var(--bg);color:#20242a;font-family:Inter,Arial,sans-serif;font-size:14px}
.app-shell{min-height:100vh}.sidebar{width:230px;background:var(--black);color:#fff;position:fixed;inset:0 auto 0 0;padding:24px 14px;z-index:100;overflow-y:auto}
.brand{font-size:20px;font-weight:800;letter-spacing:.3px;padding:0 10px 30px}.brand span{color:var(--orange)}
.nav-link-custom{display:flex;align-items:center;gap:10px;padding:12px 11px;margin:4px 0;border-radius:5px;color:#e5e7eb;text-decoration:none;font-size:14px;transition:.15s}
.nav-link-custom:hover,.nav-link-custom.active{background:var(--orange);color:#fff}.nav-caption{font-size:10px;text-transform:uppercase;letter-spacing:1.2px;color:#8b8b8b;padding:20px 11px 6px}
.main{margin-left:230px;padding:30px;min-width:0}.page-heading{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:24px}.page-heading h1{font-size:27px;font-weight:750;margin:0 0 5px}.page-heading p{color:var(--muted);margin:0}
.stat-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-bottom:20px}.stat-card{background:var(--orange);color:white;border-radius:8px;padding:19px 21px;min-height:100px;box-shadow:0 3px 10px #0000000d}.stat-card small{font-size:12px;opacity:.95}.stat-card strong{display:block;font-size:25px;margin-top:8px}
.filter-panel{background:var(--orange);color:#fff;padding:18px;border-radius:8px;margin-bottom:20px}.filter-panel h2{font-size:15px;font-weight:700;margin:0 0 14px}.filter-panel label{font-size:12px;margin-bottom:5px}.filter-panel .form-control,.filter-panel .form-select{height:38px;font-size:13px;border:0}
.panel{background:#fff;border-radius:8px;box-shadow:0 2px 8px #0000000b;overflow:hidden}.panel-heading{padding:17px 19px;display:flex;align-items:center;justify-content:space-between;gap:12px}.panel-heading h2{font-size:16px;font-weight:750;margin:0}
.table{margin:0}.table thead th{background:var(--orange);color:#fff;border:0;padding:12px 11px;font-size:12px;white-space:nowrap}.table tbody td{padding:13px 11px;font-size:13px;vertical-align:middle;border-color:#edf0f2}.table tbody tr:hover{background:#fff9f3}
.btn-orange{background:var(--orange);border-color:var(--orange);color:#fff}.btn-orange:hover{background:var(--orange-dark);border-color:var(--orange-dark);color:#fff}.btn-dark-custom{background:#111;color:#fff;border:0}.btn-dark-custom:hover{background:#333;color:#fff}
.form-card{background:#fff;padding:24px;border-radius:9px;box-shadow:0 2px 9px #0000000b}.form-label{font-weight:650}.form-control,.form-select{font-size:14px}.empty-state{text-align:center;color:var(--muted);padding:38px!important}
.alert{border-radius:7px}.badge-active{background:#198754}.badge-inactive{background:#dc3545}
@media(max-width:900px){.sidebar{width:190px}.main{margin-left:190px;padding:22px}.stat-grid{grid-template-columns:1fr}}
@media(max-width:650px){.sidebar{position:static;width:100%;padding:14px}.brand{padding-bottom:12px}.sidebar nav{display:grid;grid-template-columns:repeat(2,minmax(0,1fr))}.nav-caption{display:none}.main{margin:0;padding:18px}.page-heading{flex-direction:column}.stat-grid{grid-template-columns:1fr}}
</style>
@stack('styles')
</head>
<body>
<div class="app-shell">
<aside class="sidebar">
 <div class="brand">MINA <span>CONTROL</span></div>
 <nav>
  <a class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">▦ Dashboard</a>
  <a class="nav-link-custom {{ request()->routeIs('producoes.*') ? 'active' : '' }}" href="{{ route('producoes.index') }}">⚒ Produção</a>
  <a class="nav-link-custom {{ request()->routeIs('movimentacoes.*') ? 'active' : '' }}" href="{{ route('movimentacoes.index') }}">⇄ Movimentações</a>
  <a class="nav-link-custom {{ request()->routeIs('patios.*') ? 'active' : '' }}" href="{{ route('patios.index') }}">▧ Pátios</a>
  <a class="nav-link-custom {{ request()->routeIs('materiais.*') ? 'active' : '' }}" href="{{ route('materiais.index') }}">◇ Materiais</a>
  <div class="nav-caption">Gestão</div>
  <a class="nav-link-custom {{ request()->routeIs('relatorios') ? 'active' : '' }}" href="{{ route('relatorios') }}">▤ Relatórios</a>
  <a class="nav-link-custom {{ request()->routeIs('sodep.*') ? 'active' : '' }}" href="{{ route('sodep.form') }}">↻ Integração SODEP</a>
 </nav>
</aside>
<main class="main">
 @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
 @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
 @if($errors->any())<div class="alert alert-danger"><strong>Verifique os campos:</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
 @yield('content')
 <footer class="text-center text-muted small mt-4">Mina Control · Gerenciamento de Produção</footer>
</main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body></html>
