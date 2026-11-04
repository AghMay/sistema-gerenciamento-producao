<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Material</title>
</head>
<body>

    <h1>Cadastrar Material</h1>

    <form action="{{ route('materiais.store') }}" method="POST">

        @csrf

        <div>
            <label for="nome">Nome:</label>
            <br>
            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="tipo">Tipo:</label>
            <br>
            <input
                type="text"
                id="tipo"
                name="tipo"
                value="{{ old('tipo') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="descricao">Descrição:</label>
            <br>
            <textarea
                id="descricao"
                name="descricao"
                rows="4"
            >{{ old('descricao') }}</textarea>
        </div>

        <br>

        <div>
            <label for="ativo">Ativo:</label>
            <br>
            <select id="ativo" name="ativo">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <br>

        <button type="submit">
            Cadastrar
        </button>

        <a href="{{ route('materiais.index') }}">
            Voltar
        </a>

    </form>

</body>
</html>
