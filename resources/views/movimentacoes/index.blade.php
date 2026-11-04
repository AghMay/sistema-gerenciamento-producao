<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Movimentações</title>
</head>

<body>

    <h1>Movimentações</h1>

    @if(session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('movimentacoes.create') }}">
            Nova Movimentação
        </a>
    </p>

    @if($movimentacoes->count() > 0)

        <table border="1" cellpadding="8" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Material</th>
                    <th>Pátio de Origem</th>
                    <th>Pátio de Destino</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach($movimentacoes as $movimentacao)

                    <tr>

                        <td>
                            {{ $movimentacao->id }}
                        </td>

                        <td>
                            {{ $movimentacao->material->nome ?? 'Não informado' }}
                        </td>

                        <td>
                            {{ $movimentacao->patioOrigem->nome ?? 'Não informado' }}
                        </td>

                        <td>
                            {{ $movimentacao->patioDestino->nome ?? 'Não informado' }}
                        </td>

                        <td>
                            {{ $movimentacao->quantidade }}
                        </td>

                        <td>
                            {{ $movimentacao->data_movimentacao }}
                        </td>

                        <td>
                            {{ $movimentacao->hora_movimentacao }}
                        </td>

                        <td>
                            {{ $movimentacao->observacao ?? '—' }}
                        </td>

                        <td>

                            <a href="{{ route('movimentacoes.show', $movimentacao->id) }}">
                                Visualizar
                            </a>

                            |

                            <a href="{{ route('movimentacoes.edit', $movimentacao->id) }}">
                                Editar
                            </a>

                            |

                            <form
                                action="{{ route('movimentacoes.destroy', $movimentacao->id) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Deseja realmente excluir esta movimentação?')"
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

        <p>
            Nenhuma movimentação cadastrada.
        </p>

    @endif

    <br>

    <a href="{{ url('/') }}">
        Voltar para início
    </a>

</body>

</html>
