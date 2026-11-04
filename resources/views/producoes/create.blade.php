<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nova Produção</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f5f7;
            color: #1f2937;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin-top: 6px;
            color: #6b7280;
        }

        .btn-voltar {
            text-decoration: none;
            background: #374151;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .campo {
            display: flex;
            flex-direction: column;
        }

        .campo.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #f28c28;
        }

        .erro {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .acoes {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 11px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-cancelar {
            background: #e5e7eb;
            color: #374151;
            text-decoration: none;
        }

        .btn-salvar {
            background: #f28c28;
            color: white;
        }

        .btn-salvar:hover {
            background: #d97706;
        }

        .alerta {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .campo.full {
                grid-column: auto;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>Nova Produção</h1>
            <p>Cadastre uma nova produção manualmente.</p>
        </div>

        <a href="{{ route('producoes.index') }}" class="btn-voltar">
            ← Voltar
        </a>

    </div>

    @if ($errors->any())
        <div class="alerta">

            <strong>Verifique os campos abaixo:</strong>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <div class="card">

        <form action="{{ route('producoes.store') }}" method="POST">

            @csrf

            <div class="grid">

                <!-- MATERIAL -->
                <div class="campo">

                    <label for="material_id">
                        Material
                    </label>

                    <select name="material_id" id="material_id">

                        <option value="">
                            Selecione o material
                        </option>

                        @foreach ($materiais as $material)

                            <option
                                value="{{ $material->id }}"
                                {{ old('material_id') == $material->id ? 'selected' : '' }}
                            >
                                {{ $material->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('material_id')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- ORIGEM -->
                <div class="campo">

                    <label for="origem_id">
                        Origem
                    </label>

                    <select name="origem_id" id="origem_id">

                        <option value="">
                            Selecione a origem
                        </option>

                        @foreach ($origens as $origem)

                            <option
                                value="{{ $origem->id }}"
                                {{ old('origem_id') == $origem->id ? 'selected' : '' }}
                            >
                                {{ $origem->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('origem_id')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- DESTINO -->
                <div class="campo">

                    <label for="destino_id">
                        Destino
                    </label>

                    <select name="destino_id" id="destino_id">

                        <option value="">
                            Selecione o destino
                        </option>

                        @foreach ($destinos as $destino)

                            <option
                                value="{{ $destino->id }}"
                                {{ old('destino_id') == $destino->id ? 'selected' : '' }}
                            >
                                {{ $destino->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('destino_id')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- DATA -->
                <div class="campo">

                    <label for="data_producao">
                        Data da produção
                    </label>

                    <input
                        type="date"
                        name="data_producao"
                        id="data_producao"
                        value="{{ old('data_producao', now()->format('Y-m-d')) }}"
                    >

                    @error('data_producao')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- QUANTIDADE -->
                <div class="campo">

                    <label for="quantidade">
                        Quantidade
                    </label>

                    <input
                        type="number"
                        name="quantidade"
                        id="quantidade"
                        step="0.01"
                        min="0"
                        value="{{ old('quantidade') }}"
                        placeholder="Ex.: 150.50"
                    >

                    @error('quantidade')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- UNIDADE -->
                <div class="campo">

                    <label for="unidade">
                        Unidade
                    </label>

                    <select name="unidade" id="unidade">

                        <option value="t"
                            {{ old('unidade', 't') == 't' ? 'selected' : '' }}>
                            Toneladas (t)
                        </option>

                        <option value="kg"
                            {{ old('unidade') == 'kg' ? 'selected' : '' }}>
                            Quilogramas (kg)
                        </option>

                    </select>

                    @error('unidade')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>


                <!-- OBSERVAÇÃO -->
                <div class="campo full">

                    <label for="observacao">
                        Observação
                    </label>

                    <textarea
                        name="observacao"
                        id="observacao"
                        placeholder="Digite uma observação, se necessário..."
                    >{{ old('observacao') }}</textarea>

                    @error('observacao')
                        <span class="erro">{{ $message }}</span>
                    @enderror

                </div>

            </div>


            <div class="acoes">

                <a
                    href="{{ route('producoes.index') }}"
                    class="btn btn-cancelar"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-salvar"
                >
                    Salvar produção
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
