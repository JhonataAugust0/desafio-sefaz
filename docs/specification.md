# Documentação do Desafio Maceió IN

Esta documentação detalha os requisitos e as funcionalidades para o desenvolvimento do site **"Maceió IN"**. O projeto visa avaliar conceitos básicos de front-end, back-end, banco de dados e o uso dos frameworks Laravel e Vue.js para fins de seleção do processo de estágio da Secretaria da Fazenda da Prefeitura de Maceió, conforme os seguintes objetivos:

- **Front-end:** Avaliar design, criatividade e padrões de código.
- **Back-end:** Validar funcionamento, desempenho e segurança.
- **Banco de dados:** Analisar a forma de ingestão e controle de dados.
- **Frameworks:** Utilizar Laravel para o back-end e Vue.js para o front-end.

---

## Sumário

- [Documentação do Desafio Maceió IN](#documentação-do-desafio-maceió-in)
  - [Sumário](#sumário)
  - [Introdução](#introdução)
  - [Personas](#personas)
    - [1. Gilberto – Administrador do Site](#1-gilberto--administrador-do-site)
    - [2. Usuário Autenticado (Funcionário ou Visitante Interno)](#2-usuário-autenticado-funcionário-ou-visitante-interno)
  - [Histórias-de-Usuário](#histórias-de-usuário)
  - [Requisitos Funcionais](#requisitos-funcionais)
  - [Requisitos Não Funcionais](#requisitos-não-funcionais)
  - [Tecnologias e Padrões Utilizados](#tecnologias-e-padrões-utilizados)

---

## Introdução

O projeto "Maceió IN" tem como objetivo desenvolver um site simples e minimalista para Gilberto. O site servirá como uma apresentação institucional da Secretaria de Fazenda de Maceió, contendo uma landing page com uma breve descrição das atividades e informações institucionais. Além disso, deverá incluir um sistema de controle de usuários (login) e um módulo de gerenciamento de cadastros de pessoas, exibindo uma tabela com os dados: nome, setor e e-mail. Os setores disponíveis são: **Contabilidade, Financeiro, Atendimento, Orçamento e TI**.

---

## Personas

### 1. Gilberto – Administrador do Site

- **Perfil:**  
  - Responsável pelo gerenciamento do conteúdo do site.
  - Utiliza o sistema para inserir, atualizar ou remover cadastros de pessoas.

- **Necessidades:**  
  - Acesso seguro ao sistema via login.
  - Facilidade para gerenciar cadastros (CRUD – criar, ler, atualizar e excluir) de  funcionários de forma eficiente .
  - Garantir a segurança dos dados institucionais  
  - Manter a integridade das informações exibidas no portal.
  - Interface intuitiva e alinhada à identidade visual de maceio.al.gov.br.

### 2. Usuário Autenticado (Funcionário ou Visitante Interno)

- **Perfil:**  
  - Membro da Secretaria ou colaborador que necessita consultar informações.
  - Acessa o site para visualizar a descrição institucional e a lista de pessoas cadastradas.

- **Necessidades:**  
  - Visualizar informações institucionais e a lista de funcionários de forma clara.
  - Interface agradável e responsiva, com design minimalista.

---

## Histórias-de-Usuário

1. **Login e Autenticação**  
   - ***Como*** administrador,  
     ***Quero*** fazer login no sistema,  
     ***Para*** ter acesso seguro ao painel de administração e gerenciar os cadastros.

2. **Visualização da Landing Page**  
   - ***Como*** usuário autenticado,  
     ***Quero*** visualizar uma landing page com uma breve descrição da Secretaria de Fazenda de Maceió e suas atividades,  
     ***Para*** compreender a missão e os serviços oferecidos pela secretaria.

3. **Listagem de Cadastros**  
   - ***Como*** administrador,  
     ***Quero*** visualizar uma tabela contendo os cadastros de pessoas com as colunas: nome, setor e e-mail,  
     ***Para*** ter uma visão clara dos funcionários ou colaboradores cadastrados.

4. **Criação de Cadastro**  
   - ***Como*** administrador,  
     ***Quero*** adicionar um novo cadastro de pessoa,  
     ***Para*** atualizar a lista de colaboradores com informações relevantes.

5. **Atualização de Cadastro**  
   - ***Como*** administrador,  
     ***Quero*** editar os dados de um cadastro existente,  
     ***Para*** corrigir ou atualizar as informações quando necessário.

6. **Exclusão de Cadastro**  
   - ***Como*** administrador,  
     ***Quero*** remover um cadastro da lista,  
     ***Para*** eliminar informações desatualizadas ou incorretas.

7. **Consistência de Setores**  
   - ***Como*** administrador,  
     ***Quero*** ter a opção de selecionar entre os setores predefinidos (Contabilidade, Financeiro, Atendimento, Orçamento e TI) ao cadastrar ou editar um usuário,  
     ***Para*** manter a padronização dos dados.

---

## Requisitos Funcionais

1. **Autenticação e Controle de Acesso**  
   - Implementar sistema de login para acesso restrito às funcionalidades administrativas.
   - Restringir operações de criação, edição e exclusão de cadastros apenas a usuários e com role de admin.

2. **Landing Page**  
   - Exibir uma página inicial com uma breve descrição sobre a Secretaria de Fazenda de Maceió.
   - Utilizar design minimalista e agradável, seguindo a identidade visual de maceio.al.gov.br.

3. **Gestão de Cadastros (CRUD)**  
   - **Criação:**  
     - Formulário para cadastro de nova pessoa com os campos: nome, setor (seleção entre Contabilidade, Financeiro, Atendimento, Orçamento e TI) e e-mail.
     - Validação de campos (ex.: formato do e-mail).
   - **Leitura:**  
     - Exibição de uma tabela com os dados cadastrados.
     - Funcionalidade de pesquisa e ordenação.
   - **Atualização:**  
     - Permitir a edição dos dados de um cadastro existente.
     - Atualizar as informações no banco de dados de forma segura.
   - **Exclusão:**  
     - Permitir a remoção de cadastros.
     - Confirmar a ação antes de efetivar a exclusão.

4. **Integração com o Banco de Dados**  
   - Utilizar migrations para criação e controle do esquema do banco de dados.
   - Garantir integridade e consistência dos dados.

5. **Interface e Responsividade**  
   - Desenvolver a interface utilizando Vue.js para componentes dinâmicos.
   - Assegurar que o design seja responsivo, adaptando-se a diferentes dispositivos e tamanhos de tela.

6. **Design e Identidade Visual**  
   - Aplicar paleta de cores e ambientação inspiradas no site maceio.al.gov.br.
   6.1 Paleta de Cores (Base: maceio.al.gov.br)
     | Tipo| Hexadecimal  | Uso  |
     | ------------------ | -----------| ----------------------|
     | Azul | Primário	#F58428 |	Cabeçalhos  |
     | Verde | Secundário	#14467C | Botões Primários |
     | Cinza | Fundo	##FFFFFF |	Background |

   - Manter consistência visual em todas as páginas do site.

---

## Requisitos Não Funcionais

1. **Desempenho**  
   - Garantir que o site tenha tempo de resposta rápido, com carregamento eficiente das páginas e dos dados.
   - Otimizar consultas ao banco de dados e uso de componentes front-end.

2. **Segurança**  
   - Implementar práticas de segurança no back-end (proteção contra SQL Injection, XSS, CSRF, etc.).
   - Utilizar métodos seguros para a autenticação e gerenciamento de sessões.
   - Criptografar senhas e dados sensíveis dos usuários.

3. **Usabilidade e Experiência do Usuário (UX)**  
   - Interface intuitiva, de fácil navegação e que proporcione uma boa experiência ao usuário.
   - Feedback claro para ações realizadas (ex.: confirmação de cadastro, alerta de erro de validação).

4. **Manutenibilidade e Legibilidade do Código**  
   - Seguir padrões de código e boas práticas recomendadas para Laravel e Vue.js.
   - Documentar o código e estruturar a aplicação de forma modular, facilitando futuras manutenções e expansões.

5. **Compatibilidade**  
   - Garantir que o site funcione corretamente nos principais navegadores modernos.
   - Assegurar a compatibilidade com diferentes sistemas operacionais e dispositivos móveis.

6. **Escalabilidade**  
   - Estruturar a aplicação de forma a permitir a adição de novas funcionalidades no futuro sem grandes refatorações.
   - Preparar o sistema para potencial aumento de usuários e cadastros sem comprometer o desempenho.

---

## Tecnologias e Padrões Utilizados

- **Back-end:**  
  - **Laravel:** Framework PHP robusto para desenvolvimento de APIs e lógica de negócio.
  - Uso de migrations para gerenciamento do esquema do banco de dados.
  - Implementação de autenticação utilizando as ferramentas nativas do Laravel.

- **Front-end:**  
  - **Vue.js:** Framework JavaScript para a criação de interfaces reativas e componentes dinâmicos.
  - Integração com o back-end via API RESTful.

- **Banco de Dados:**  
  - Utilização de um SGBD relacional (por exemplo, MySQL ou PostgreSQL) para armazenamento dos cadastros.

- **Padrões de Código:**  
  - Seguir as PSR (PHP Standards Recommendations) no desenvolvimento do back-end.
  - Aplicar boas práticas de componentes e organização de arquivos no Vue.js.

- **Design:**  
  - Utilização de uma paleta de cores e ambientação inspiradas no site maceio.al.gov.br.
  - Interface minimalista, moderna e responsiva.

---
