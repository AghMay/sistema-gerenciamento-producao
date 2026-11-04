<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produção - Mina Control</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f5f7;
            color: #222;
        }

        /* ========================================
           LAYOUT
        ======================================== */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ========================================
           MENU LATERAL
        ======================================== */

        .sidebar {
            width: 220px;
            background: #111111;
            color: white;
            min-height: 100vh;

            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            padding-top: 20px;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;

            padding: 0 20px 25px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin: 2px 0;
        }

        .menu a {
            display: block;

            color: #dddddd;
            text-decoration: none;

            padding: 11px 20px;

            font-size: 14px;

            transition: 0.2s;
        }

        .menu a:hover {
            background: #292929;
            color: white;
        }

        .menu a.active {
            background: #f28c28;
            color: white;
            font-weight: bold;
        }

        /* ========================================
           CONTEÚDO
        ======================================== */

        .content {
            margin-left: 220px;

            width: calc(100% - 220px);

            padding: 30px 40px;
        }

        /* ========================================
           TÍTULO
        ======================================== */

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin: 0;

            font-size: 28px;
            font-weight: 600;
        }

        .page-title p {
            margin-top: 7px;

            color: #777777;

            font-size: 14px;
        }

        /* ========================================
           ALERTA
        ======================================== */

        .alert {
            background: #dcfce7;
            color: #166534;

            padding: 12px 15px;

            border-radius: 5px;

            margin-bottom: 20px;

            font-size: 13px;
        }

        /* ========================================
           CARDS
        ======================================== */

        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;

            margin-bottom: 22px;
        }

        .card-indicator {
            background: #f28c28;

            color: white;

            border-radius: 6px;

            padding: 18px;

            min-height: 95px;
        }

        .card-indicator .titulo {
            font-size: 13px;

            margin-bottom: 15px;
        }

        .card-indicator .valor {
            font-size: 20px;

            font-weight: bold;
        }

        /* ========================================
           FILTROS
        ======================================== */

        .filtros {
            background: #f28c28;

            color: white;

            border-radius: 6px;

            padding: 18px;

            margin-bottom: 22px;
        }

        .filtros h3 {
            margin: 0 0 15px;

            font-size: 15px;

            font-weight: normal;
        }

        .filtros-grid {
            display: grid;

            grid-template-columns:
                1fr
                1fr
                1fr
                auto;

            gap: 15px;

            align-items: end;
        }

        .campo {
            display: flex;

            flex-direction: column;

            gap: 6px;
        }

        .campo label {
            font-size: 12px;
        }

        .campo input,
        .campo select {
            width: 100%;

            height: 34px;

            border: none;

            border-radius: 4px;

            padding: 0 10px;

            font-size: 13px;

            outline: none;

            background: white;
        }

        .btn-pesquisar {
            height: 34px;

            padding: 0 25px;

            border: none;

            border-radius: 5px;

            background: #111111;

            color: white;

            cursor: pointer;

            font-size: 13px;
        }

        .btn-pesquisar:hover {
            background: #292929;
        }

        /* ========================================
           TABELA
        ======================================== */

        .tabela-container {
            background: white;

            border-radius: 6px;

            overflow: hidden;

            box-shadow:
                0 1px 5px rgba(0, 0, 0, 0.08);
        }

        .tabela-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 18px;

            border-bottom: 1px solid #eeeeee;
        }

        .tabela-header h2 {
            margin: 0;

            font-size: 17px;
        }

        .btn-nova {
            background: #f28c28;

            color: white;

            text-decoration: none;

            padding: 9px 15px;

            border-radius: 5px;

            font-size: 13px;
        }

        .btn-nova:hover {
            background: #dc7616;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        th {
            background: #f28c28;

            color: white;

            text-align: left;

            padding: 12px 10px;

            font-size: 12px;

            font-weight: 600;

            white-space: nowrap;
        }

        td {
            padding: 12px 10px;

            border-bottom:
                1px solid #eeeeee;

            font-size: 12px;

            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        /* ========================================
           STATUS
        ======================================== */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            font-size: 12px;
        }

        .status-dot {
            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: #22c55e;
        }

        /* ========================================
           AÇÕES
        ======================================== */

        .acoes {
            display: flex;

            gap: 5px;
        }

        .btn-acao {
            border: none;

            padding: 6px 9px;

            border-radius: 4px;

            font-size: 11px;

            text-decoration: none;

            cursor: pointer;
        }

        .btn-ver {
            background: #e5f3ff;

            color: #0067a3;
        }

        .btn-editar {
            background: #fff1d6;

            color: #a65b00;
        }

        .btn-excluir {
            background: #ffe4e4;

            color: #b40000;
        }

        /* ========================================
           PAGINAÇÃO
        ======================================== */

        .paginacao {
            padding: 18px;
        }

        /* ========================================
           VAZIO
        ======================================== */

        .vazio {
            text-align: center;

            padding: 40px;

            color: #777777;
        }

        /* ========================================
           RESPONSIVO
        ======================================== */

        @media (max-width: 1000px) {

            .sidebar {
                width: 190px;
            }

            .content {
                margin-left: 190px;

                width: calc(100% - 190px);

                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .filtros-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>


<body>

<div class="layout">

    <!-- ========================================
         MENU LATERAL
    ======================================== -->

    <aside class="sidebar">

        <div class="logo">
            Mina Control
        </div>

        <ul class="menu">

            <li>
                <a href="#">
                    ▦ Dashboard
                </a>
            </li>

            <li>
                <a
                    href="{{ route('producoes.index') }}"
                    class="active"
                >
                    ◫ Produção
                </a>
            </li>

            <li>
                <a href="#">
                    ⇄ Movimentações
                </a>
            </li>

            <li>
                <a href="#">
                    ▧ Pátios
                </a>
            </li>

            <li>
                <a href="#">
                    ◈ Materiais
                </a>
            </li>

            <li>
                <a href="#">
                    ▤ Relatórios
                </a>
            </li>

            <li>
                <a href="#">
                    ♙ Usuários
                </a>
            </li>

            <li>
                <a href="#">
                    ⚙ Configurações
                </a>
            </li>

        </ul>

    </aside>


    <!-- ========================================
         CONTEÚDO PRINCIPAL
    ======================================== -->

    <main class="content">


        <!-- ====================================
             TÍTULO
        ==================================== -->

        <div class="page-title">

            <h1>
                Produção
            </h1>

            <p>
                Controle e acompanhamento da produção
            </p>

        </div>


        <!-- ====================================
             MENSAGEM DE SUCESSO
        ==================================== -->

        @if(session('success'))

            <div class="alert">

                {{ session('success') }}

            </div>

        @endif


        <!-- ====================================
             CARDS
        ==================================== -->

        <div class="cards">


            <!-- PRODUÇÃO HOJE -->

            <div class="card-indicator">

                <div class="titulo">
                    Produção hoje
                </div>

                <div class="valor">

                    {{ number_format(
                        $producaoHoje,
                        2,
                        ',',
                        '.'
                    ) }}

                    t

                </div>

            </div>


            <!-- PRODUÇÃO MÊS -->

            <div class="card-indicator">

                <div class="titulo">
                    Produção mês
                </div>

                <div class="valor">

                    {{ number_format(
                        $producaoMes,
                        2,
                        ',',
                        '.'
                    ) }}

                    t

                </div>

            </div>


            <!-- TOTAL DE REGISTROS -->

            <div class="card-indicator">

                <div class="titulo">
                    Registros
                </div>

                <div class="valor">

                    {{ number_format(
                        $totalRegistros,
                        0,
                        ',',
                        '.'
                    ) }}

                </div>

            </div>


        </div>


        <!-- ====================================
             FILTROS
        ==================================== -->

        <div class="filtros">

            <h3>
                Filtros
            </h3>


            <form
                method="GET"
                action="{{ route('producoes.index') }}"
            >

                <div class="filtros-grid">


                    <!-- DATA -->

                    <div class="campo">

                        <label>
                            Data
                        </label>

                        <input
                            type="date"
                            name="data"
                            value="{{ request('data') }}"
                        >

                    </div>


                    <!-- LITOLOGIA -->

                    <div class="campo">

                        <label>
                            Litologia
                        </label>

                        <select name="litologia">

                            <option value="">
                                Todas
                            </option>


                            @foreach($litologias as $litologia)

                                <option
                                    value="{{ $litologia }}"
                                    {{ request('litologia') == $litologia ? 'selected' : '' }}
                                >

                                    {{ $litologia }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- ORIGEM -->

                    <div class="campo">

                        <label>
                            Origem
                        </label>

                        <select name="origem_id">

                            <option value="">
                                Todas
                            </option>


                            @foreach($origens as $origem)

                                <option
                                    value="{{ $origem->id }}"
                                    {{ request('origem_id') == $origem->id ? 'selected' : '' }}
                                >

                                    {{ $origem->nome }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- BOTÃO -->

                    <button
                        type="submit"
                        class="btn-pesquisar"
                    >
                        Pesquisar
                    </button>


                </div>

            </form>

        </div>


        <!-- ====================================
             TABELA
        ==================================== -->

        <div class="tabela-container">


            <!-- CABEÇALHO -->

            <div class="tabela-header">

                <h2>
                    Registros de produção
                </h2>


                <a
                    href="{{ route('producoes.create') }}"
                    class="btn-nova"
                >
                    + Nova Produção
                </a>

            </div>


            <!-- TABELA -->

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Data
                            </th>

                            <th>
                                Produto
                            </th>

                            <th>
                                Origem
                            </th>

                            <th>
                                Destino
                            </th>

                            <th>
                                Litologia
                            </th>

                            <th>
                                Quantidade
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($producoes as $producao)


                            <tr>


                                <!-- DATA -->

                                <td>

                                    {{ $producao->data_producao?->format('d/m/Y') }}

                                </td>


                                <!-- PRODUTO -->

                                <td>

                                    {{ $producao->material->nome ?? 'Não informado' }}

                                </td>


                                <!-- ORIGEM -->

                                <td>

                                    {{ $producao->origem->nome ?? 'Não informado' }}

                                </td>


                                <!-- DESTINO -->

                                <td>

                                    {{ $producao->destino->nome ?? 'Não informado' }}

                                </td>


                                <!-- LITOLOGIA -->

                                <td>

                                    {{ $producao->litologia ?? '—' }}

                                </td>


                                <!-- QUANTIDADE -->

                                <td>

                                    <strong>

                                        {{ number_format(
                                            $producao->quantidade,
                                            2,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                    {{ $producao->unidade }}

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span class="status">

                                        <span class="status-dot"></span>


                                        @if($producao->sodep_id)

                                            Importado

                                        @else

                                            Manual

                                        @endif


                                    </span>

                                </td>


                                <!-- AÇÕES -->

                                <td>

                                    <div class="acoes">


                                        <!-- VER -->

                                        <a
                                            href="{{ route(
                                                'producoes.show',
                                                $producao
                                            ) }}"
                                            class="btn-acao btn-ver"
                                        >
                                            Ver
                                        </a>


                                        <!-- EDITAR -->

                                        <a
                                            href="{{ route(
                                                'producoes.edit',
                                                $producao
                                            ) }}"
                                            class="btn-acao btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <!-- EXCLUIR -->

                                        <form
                                            action="{{ route(
                                                'producoes.destroy',
                                                $producao
                                            ) }}"
                                            method="POST"

                                            onsubmit="return confirm(
                                                'Deseja realmente excluir esta produção?'
                                            );"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn-acao btn-excluir"
                                            >
                                                Excluir
                                            </button>

                                        </form>


                                    </div>

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td
                                    colspan="8"
                                    class="vazio"
                                >

                                    Nenhuma produção encontrada.

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>


            <!-- ====================================
                 PAGINAÇÃO
            ==================================== -->

            <div class="paginacao">

                {{ $producoes->withQueryString()->links() }}

            </div>


        </div>


    </main>

</div>


</body>

</html>
