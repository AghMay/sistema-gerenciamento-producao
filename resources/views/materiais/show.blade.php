<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visualizar Material</title>
</head>

<body>

    <h1>Detalhes do Material</h1>

    <p>
        <strong>ID:</strong>
        {{ $material->id }}
    </p>

    <p>
        <strong>Nome:</strong>
        {{ $material->nome }}
    </p>

    <p>
        <strong>Tipo:</strong>
        {{ $material->tipo }}
    </p>

    <p>
        <strong>Descrição:</strong>
        {{ $material->descricao ?? 'Não informada' }}
    </p>

    <p>
        <strong>Ativo:</strong>
        {{ $material->ativo ? 'Sim' : 'Não' }}
    </p>

    <br>

    <a href="{{ route('materiais.edit', $material->id) }}">
        Editar
    </a>

    <br><br>

    <a href="{{ route('materiais.index') }}">
        Voltar para materiais
    </a>

</body>

</html>
