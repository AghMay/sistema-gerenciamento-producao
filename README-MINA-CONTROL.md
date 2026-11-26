# Mina Control — instruções de instalação

Projeto Laravel 12 / PHP 8.2+ para gerenciamento de produção, pátios, materiais e movimentações, com integração Minetrack/SODEP.

## 1. Preparar o ambiente

Requisitos: PHP 8.2 ou superior, Composer, MySQL e Node.js/npm (se for compilar os assets do Laravel).

1. Faça uma cópia de segurança da pasta atual do projeto.
2. Extraia/substitua os arquivos do pacote na pasta do projeto.
3. No terminal, dentro da pasta do projeto, execute:

```bash
composer install
```

4. Crie o arquivo `.env` a partir do `.env.example` (se ainda não existir):

```bash
copy .env.example .env
```

No Windows PowerShell também pode usar `Copy-Item .env.example .env`.

5. Gere a chave da aplicação, se ainda não houver uma:

```bash
php artisan key:generate
```

## 2. Configurar MySQL

Crie no MySQL um banco chamado `gerenciamento_producao` (collation `utf8mb4_unicode_ci`). No `.env`, confira:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gerenciamento_producao
DB_USERNAME=root
DB_PASSWORD=
```

Use a senha real do seu MySQL se houver. Não compartilhe o `.env`.

**Atenção:** não execute `php artisan migrate:fresh` em um banco que contenha dados importantes: esse comando apaga as tabelas e os registros.

Se for uma instalação nova, execute:

```bash
php artisan migrate
```

Se o banco já possui as migrations aplicadas, não é necessário recriá-las.

## 3. Configurar SODEP

No `.env`, preencha com o código de acesso fornecido pela plataforma. Não coloque o código diretamente no PHP:

```env
MINETRACK_LOGIN_URL=https://minetrack.com.br:8511/api/public/login
MINETRACK_API_URL=https://minetrack.com.br:8483
MINETRACK_CODIGO_ACESSO=COLOQUE_SEU_CODIGO_AQUI
```

Depois execute:

```bash
php artisan config:clear
```

Acesse **Integração SODEP** pelo menu, teste a autenticação e só então importe inicialmente um único dia. Valide os dados importados antes de consultar intervalos maiores.

A integração usa os campos e o contrato de API que já estavam presentes no projeto enviado. A estrutura exata do JSON retornado pela API deve ser confirmada com uma resposta real de teste; nomes de campos diferentes podem exigir ajuste no mapeamento de `SodepImportService`.

## 4. Iniciar o sistema

```bash
php artisan serve
```

Abra `http://127.0.0.1:8000`.

## 5. Módulos incluídos nesta versão

- Dashboard com indicadores e filtros de produção.
- Produção: consulta, cadastro manual e visualização.
- Movimentações: cadastro, consulta, edição, visualização e exclusão.
- Pátios: cadastro, consulta, edição, visualização e exclusão.
- Materiais: cadastro, consulta, edição, visualização e exclusão.
- Relatórios de produção por material e por origem.
- Integração SODEP: teste de autenticação e importação por período, com prevenção de duplicidade pelo `sodep_id`.

## Limites e próximos incrementos

- O módulo de usuários/login e permissões ainda não está implementado nesta versão.
- O estoque físico por pátio ainda precisa de uma regra operacional definida (saldo inicial, entradas, saídas, ajustes e vínculo de produção). A movimentação registra transferências, mas não deve ser interpretada isoladamente como inventário validado.
- A meta de produção não está configurada porque o projeto enviado não possui tabela/cadastro de metas.
- O CSS do layout usa Bootstrap via CDN; portanto, a primeira abertura requer acesso à internet para carregar o Bootstrap.
- Antes de publicar em servidor, proteger rotas administrativas com autenticação e remover ou restringir `/teste-banco`.
