# Maceió IN

Projeto desenvolvido para o desafio de estágio na Secretaria da Fazenda de Maceió. Trata-se de um site simples e minimalista, construído em Laravel e Vue.js, que oferece uma landing page institucional e um sistema de gerenciamento de cadastros com funcionalidades CRUD.

Para mais detalhes sobre os requisitos e especificações técnicas do projeto, consulte a [especificação do projeto](docs/specification.md).

---

## Funcionalidades

- **Autenticação:** Acesso seguro ao painel administrativo.
- **Landing Page:** Página inicial com descrição institucional da Secretaria.
- **Gerenciamento de Cadastros:** CRUD para pessoas com campos de nome, setor (Contabilidade, Financeiro, Atendimento, Orçamento e TI) e e-mail.
- **Design Responsivo:** Interface alinhada à identidade visual de maceio.al.gov.br.

---

## Requisitos

- PHP 8.x
- Composer
- Node.js e NPM/Yarn (para dependências do front-end)
- Docker e Docker Compose (opcional)

---

## Configuração do Ambiente

1. **Variáveis de Ambiente:**  
   Renomeie o arquivo `.env.example` para `.env` e ajuste as variáveis referentes ao banco de dados (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

2. **Instalação das Dependências:**

   - **PHP:**
     ```bash
     composer install
     ```
   - **Front-end:**
     ```bash
     npm install
     ```

3. **Gerar a Chave da Aplicação:**
   ```bash
   php artisan key:generate
   ```

4. **Executar as Migrations:**
   ```bash
   php artisan migrate
   ```

---

## Executando o Projeto

### 1. Localmente (PHP)

- Inicie o servidor de desenvolvimento:
  ```bash
  php artisan serve
  ```
  ou
  ```bash
  composer run dev
  ```
- Acesse o projeto via [http://localhost:8000](http://localhost:8000).

### 2. Com Docker

- Suba os containers utilizando o Laravel Sail:
  ```bash
  ./vendor/bin/sail up
  ```
- O projeto estará acessível em [http://localhost](http://localhost) (ou na porta configurada).

---

## Restaurando o Banco de Dados

### Pelo Docker

1. **Copiar o Dump para o Container:**
   ```bash
   docker cp database_dump.sql desafio_sefaz-pgsql-1:/database_dump.sql
   ```
2. **Restaurar o Banco de Dados:**
   ```bash
   docker exec -i desafio_sefaz-pgsql-1 psql -U postgres -d template1 < database_dump.sql
   ```

### Sem Docker

1. **Ajuste as Variáveis de Ambiente:**  
   Certifique-se de que as variáveis do banco no arquivo `.env` estão configuradas corretamente para o ambiente local (host=127.0.0.1).

2. **Restaurar Utilizando o Cliente PostgreSQL:**
   ```bash
   psql -U <seu_usuario> -d <seu_banco> -f database_dump.sql
   ```
   Substitua `<seu_usuario>` e `<seu_banco>` pelas informações do seu ambiente.

---

## Observações

- Garanta que o serviço de banco de dados esteja ativo, seja via Docker ou localmente.
- Caso opte pelo ambiente Docker, certifique-se de que todos os containers (incluindo o do PostgreSQL) estejam em execução.
- Mantenha sempre as variáveis de ambiente atualizadas para evitar problemas de conexão com o banco de dados.

---

