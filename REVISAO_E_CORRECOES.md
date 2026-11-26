# Mina Control — revisão técnica

## Correções aplicadas nesta revisão
- Corrigidos caracteres `\\n` que estavam gravados literalmente nos serviços SODEP e impediam o PHP de interpretar os arquivos.
- Mantida a autenticação Minetrack/SODEP por `codigoAcesso`, sem exibir tokens na interface.
- Mantida a consulta diária ao endpoint `api-bi/fato-producao/by-data-turno` e a importação por período.
- Mantidos os módulos de produção, movimentações, pátios, materiais, relatórios e integração SODEP, com identidade visual preta/laranja/branca.
- Verificada a sintaxe PHP de todos os arquivos PHP em `app`, `routes` e `database/migrations`.

## Antes de executar no seu computador
1. Faça uma cópia da pasta atual do projeto.
2. Extraia esta versão corrigida em uma pasta separada.
3. Copie o seu `.env` local para a pasta nova (o arquivo `.env` não é incluído neste pacote por conter credenciais).
4. Confira no `.env` as variáveis `MINETRACK_LOGIN_URL`, `MINETRACK_API_URL` e `MINETRACK_CODIGO_ACESSO`. Não compartilhe o valor de `MINETRACK_CODIGO_ACESSO`.
5. No terminal, dentro da pasta do projeto, execute `composer install` se a pasta `vendor` não existir.
6. Execute `php artisan config:clear` e `php artisan route:clear`.
7. Execute `php artisan route:list` para conferir as rotas e `php artisan serve` para abrir o sistema.

## Importante sobre banco de dados
Não execute `php artisan migrate:fresh`: esse comando apaga as tabelas e os registros existentes. Faça backup do banco antes de qualquer alteração de migration. Esta revisão não executa migrações nem altera dados do banco.

## Limite da validação
A sintaxe PHP foi validada. Como o pacote não contém `vendor` nem o `.env` real e não possui acesso ao serviço Minetrack, não foi possível executar a aplicação Laravel completa, validar a conexão real com MySQL ou autenticar na API SODEP. Faça primeiro o teste de conexão e depois importe apenas um dia conhecido.
