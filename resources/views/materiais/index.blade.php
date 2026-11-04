<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Materiais</title>
</head>
<body>

    <h1>Materiais</h1>

    <a href="{{ route('materiais.create') }}">
        Novo Material
    </a>

    <br><br>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if($materiais->count() > 0)

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach($materiais as $material)

                    <tr>
                        <td>{{ $material->id }}</td>

                        <td>{{ $material->nome }}</td>

                        <td>{{ $material->tipo }}</td>

                        <td>{{ $material->descricao }}</td>

                        <td>
                            {{ $material->ativo ? 'Sim' : 'Não' }}
                        </td>

                        <td>

                            <a href="{{ route('materiais.show', $material) }}">
                                Visualizar
                            </a>

                            |

                            <a href="{{ route('materiais.edit', $material) }}">
                                Editar
                            </a>

                            |

                            <form
                                action="{{ route('materiais.destroy', $material) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Deseja realmente excluir este material?')"
                                >
                                    Excluir
                                </button>

                            </form>

                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>

    @else

        <p>Nenhum material cadastrado.</p>

    @endif

</body>
</html>
