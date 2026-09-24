# Sistema de Gestão de Brinquedos

Sistema em PHP e MySQL para gerenciar os brinquedos de uma loja. Permite cadastrar, listar, editar e excluir brinquedos (CRUD completo). Cada brinquedo tem nome, categoria, faixa etária, preço e quantidade em estoque.

Todas as operações com o banco usam **Prepared Statements** (`mysqli_prepare` + `mysqli_stmt_bind_param`). Os dados recebidos são validados antes de serem gravados, e os erros do banco são tratados e exibidos ao usuário.

## Estrutura

- `database/database.sql`: criação do banco e da tabela `brinquedos`
- `infra/conexao.php`: conexão com o MySQL
- `infra/validacao.php`: validação dos dados do brinquedo
- `index.php`: formulário de cadastro e lista de brinquedos
- `public/cadastrar_brinquedo.php`: cadastro (Create)
- `public/editar_brinquedo.php`: edição (Update)
- `public/excluir_brinquedo.php`: exclusão (Delete)

## Como executar

1. Instale o XAMPP (ou outro servidor com PHP e MySQL) e inicie o **Apache** e o **MySQL**.
2. Coloque a pasta do projeto dentro de `htdocs`.
3. Abra o phpMyAdmin e execute o arquivo `database/database.sql` para criar o banco e a tabela.
4. Se necessário, ajuste usuário e senha do banco em `infra/conexao.php`.
5. Acesse no navegador, por exemplo:

   ```
   http://localhost:8080/lucas_lazzarotti_2026/CRUD-PHP-Sistema-de-Gest-o-de-Brinquedos/index.php
   ```

## Como cadastrar um brinquedo

1. No formulário **"Cadastrar Brinquedo!"**, preencha **Nome**, **Categoria**, **Faixa Etária**, **Preço** e **Quantidade em Estoque**.
2. Clique em **Cadastrar**.
3. Uma mensagem de confirmação será exibida. Clique em **Voltar** para retornar à página inicial.
4. O novo brinquedo aparecerá na tabela **"Brinquedos Cadastrados"**.

> Se algum campo estiver inválido (vazio, preço menor ou igual a zero, estoque negativo etc.), uma mensagem de erro será exibida.

## Como editar um brinquedo

1. Na tabela **Brinquedos Cadastrados**, clique em **Editar** na linha desejada.
2. Altere os campos que quiser e clique em **Atualizar Brinquedo**.
3. Clique em **Voltar** para retornar à página inicial e conferir a alteração.

## Como excluir um brinquedo

1. Na tabela, clique em **Excluir** na linha desejada e confirme.
2. Uma mensagem confirmará a exclusão. Clique em **Voltar** para retornar à página inicial.