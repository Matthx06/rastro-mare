# RASTRO + MARÉ — versão adaptada às novas orientações

## Alterações feitas para a nova especificação

- O site continua sendo um projeto **individual**.
- A página principal é `index.php` e agora contém a criação do banco e das tabelas SQL dentro do próprio arquivo.
- Não é mais necessário procurar um arquivo `banco.sql` nas pastas.
- O banco usado pelo formulário de contato é MySQL.
- O Livro de Visitas **não usa SQL**.
- As opiniões do Livro de Visitas são armazenadas em `data/visitas.txt`.
- Toda opinião enviada começa com status `pendente`.
- A página pública do Livro de Visitas exibe **somente** opiniões com status `aprovado`.
- Foi mantida/criada uma área administrativa em `admin/` para:
  - entrar com login;
  - visualizar opiniões pendentes, aprovadas e rejeitadas;
  - aprovar e liberar uma opinião;
  - rejeitar;
  - editar;
  - excluir.
- O arquivo TXT possui proteção por `.htaccess` para não ficar acessível diretamente pelo navegador.
- `setup.php` e `banco.sql` foram removidos, pois a inicialização SQL agora acontece no `index.php`.

## Como executar no XAMPP

1. Coloque a pasta do projeto dentro de `htdocs`.
2. Abra o XAMPP.
3. Ligue **Apache** e **MySQL**.
4. Acesse `http://localhost/NOME-DA-PASTA/index.php`.
5. O `index.php` cria automaticamente o banco `rastro_mare` e a tabela `contatos`.
6. O arquivo `data/visitas.txt` é criado automaticamente para o Livro de Visitas.

### Área administrativa

Acesse:

`http://localhost/NOME-DA-PASTA/admin/login.php`

Login inicial:

- Usuário: `admin`
- Senha: `admin123`

Para trocar as credenciais do administrador, altere `ADMIN_USER` e `ADMIN_PASS` no `config.php`.

## Estrutura principal

- `index.php` — página principal + criação do banco SQL.
- `livro.php` — formulário e exibição somente das opiniões aprovadas.
- `admin/login.php` — login do administrador.
- `admin/index.php` — aprovação, rejeição e exclusão das opiniões.
- `admin/editar.php` — edição das opiniões.
- `admin/logout.php` — encerramento da sessão.
- `config.php` — configurações e funções auxiliares.
- `data/visitas.txt` — armazenamento do Livro de Visitas.
- `data/.htaccess` — bloqueia acesso direto ao arquivo TXT.
- `contato.php` — formulário de contato, armazenado no MySQL criado pelo `index.php`.
