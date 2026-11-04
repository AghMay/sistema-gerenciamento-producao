<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nova Movimentação</title>
</head>

<body>

    <h1>Nova Movimentação</h1>

    @if ($errors->any())
        <div>
            <strong>Verifique os seguintes erros:</strong>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movimentacoes.store') }}" method="POST">

        @csrf

        <p>
            <label for="material_id">
                Material:
            </label>

            <br>

            <select name="material_id" id="material_id" required>

                <option value="">
                    Selecione um material
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
        </p>


        <p>
            <label for="patio_origem_id">
                Pátio de Origem:
            </label>

            <br>

            <select name="patio_origem_id" id="patio_origem_id" required>

                <option value="">
                    Selecione o pátio de origem
                </option>

                @foreach ($patios as $patio)
                    <option
                        value="{{ $patio->id }}"
                        {{ old('patio_origem_id') == $patio->id ? 'selected' : '' }}
                    >
                        {{ $patio->nome }}
                    </option>
                @endforeach

            </select>
        </p>


        <p>
            <label for="patio_destino_id">
                Pátio de Destino:
            </label>

            <br>

            <select name="patio_destino_id" id="patio_destino_id" required>

                <option value="">
                    Selecione o pátio de destino
                </option>

                @foreach ($patios as $patio)
                    <option
                        value="{{ $patio->id }}"
                        {{ old('patio_destino_id') == $patio->id ? 'selected' : '' }}
                    >
                        {{ $patio->nome }}
                    </option>
                @endforeach

            </select>
        </p>


        <p>
            <label for="quantidade">
                Quantidade:
            </label>

            <br>

            <input
                type="number"
                name="quantidade"
                id="quantidade"
                step="0.01"
                min="0"
                value="{{ old('quantidade') }}"
                required
            >
        </p>


        <p>
            <label for="data_movimentacao">
                Data da Movimentação:
            </label>

            <br>

            <input
                type="date"
                name="data_movimentacao"
                id="data_movimentacao"
                value="{{ old('data_movimentacao') }}"
                required
            >
        </p>


        <p>
            <label for="hora_movimentacao">
                Hora da Movimentação:
            </label>

            <br>

            <input
                type="time"
                name="hora_movimentacao"
                id="hora_movimentacao"
                value="{{ old('hora_movimentacao') }}"
                required
            >
        </p>


        <p>
            <label for="observacao">
                Observação:
            </label>

            <br>

            <textarea
                name="observacao"
                id="observacao"
                rows="4"
                cols="50"
            >{{ old('observacao') }}</textarea>
        </p>


        <button type="submit">
            Cadastrar Movimentação
        </button>

    </form>

    <br>

    <a href="{{ route('movimentacoes.index') }}">
        Voltar para movimentações
    </a>

</body>

</html>
