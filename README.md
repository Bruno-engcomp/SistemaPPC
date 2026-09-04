# 🏛️ Sistema PPC (Projeto Pedagógico de Curso)

Sistema de gestão, tramitação e homologação de Projetos Pedagógicos de Curso (PPC) desenvolvido com **Laravel 12**, **Vue.js 3 (Inertia.js)** e **MySQL 8.0**.

---

## 📂 Estrutura Completa do Projeto

```
sistema-ppc/
├── app/
│   ├── Enums/
│   │   └── StatusProposta.php              # Centraliza os status (SUBMETIDO, RETORNADO, etc.)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php     # Autenticação e Logout
│   │   │   │   └── RegisterController.php  # Cadastro de usuários com perfil
│   │   │   ├── PropostaController.php      # Ações da Unidade Acadêmica (FCT/ITEC)
│   │   │   ├── AvaliacaoController.php     # Ações do Avaliador Técnico
│   │   │   └── CamaraController.php        # Ações da Câmara de Ensino
│   │   ├── Middleware/
│   │   │   └── HandleInertiaRequests.php   # Compartilhamento de sessão auth no Vue
│   │   └── Requests/
│   │       └── PropostaStoreRequest.php    # Validação dos formulários
│   └── Models/
│       ├── User.php                        # Usuário com papel (UNIDADE, AVALIADOR, CAMARA)
│       ├── Unidade.php                     # FCT (fct@ufpa.com.br), ITEC (itec@ufpa.com.br)
│       ├── Proposta.php                    # Engenharia da Computação, Engenharia Elétrica
│       ├── Disciplina.php                  # Códigos de matéria (EC0001, EE0001, etc.)
│       └── Avaliacao.php                   # Parecer técnico
│
├── database/
│   ├── migrations/                         # Estrutura do banco MySQL 8.0
│   └── seeders/                            # Cursos da FCT/ITEC e contas de teste
│
├── resources/
│   ├── js/                                 # FRONTEND (VUE.JS 3)
│   │   ├── Components/
│   │   │   ├── Navbar.vue                  # Navegação SPA com dados do usuário logado
│   │   │   ├── StatusBadge.vue             # Tag visual do status da proposta
│   │   │   └── DisciplinaForm.vue          # Formulário dinâmico de disciplinas
│   │   ├── Pages/
│   │   │   ├── Auth/
│   │   │   │   ├── Login.vue               # Tela de Login com credenciais de teste
│   │   │   │   └── Register.vue            # Tela de Cadastro com perfil/unidade
│   │   │   ├── Unidade/ (Index.vue, Form.vue)
│   │   │   ├── Avaliador/ (Index.vue, Avaliar.vue)
│   │   │   └── Camara/ (Index.vue, Decisao.vue)
│   │   ├── Layouts/
│   │   │   └── MainLayout.vue              # Shell principal com transição de páginas
│   │   └── app.js                          # Instância do Vue 3 e Inertia
│   └── views/
│       └── app.blade.php                   # View base HTML
│
├── routes/
│   └── web.php                             # Rotas de Auth e Proteção por Middleware
│
├── docker-compose.yml                      # Ambiente MySQL 8.0 (Porta 33060)
└── README.md                               # Documentação completa
```

---

## 🔑 Credenciais de Teste para Demonstração

| Perfil | E-mail de Acesso | Senha | Unidade / Permissões |
| :--- | :--- | :--- | :--- |
| **Unidade Acadêmica** | `fct@ufpa.com.br` | `senha123` | Faculdade de Computação e Telecomunicações (Cria/Edita PPCs) |
| **Avaliador Técnico** | `avaliador@ufpa.br` | `senha123` | Emite pareceres técnicos detalhados |
| **Câmara de Ensino** | `camara@ufpa.br` | `senha123` | Delibera e homologa propostas finais |

---

## 📚 Cursos e Disciplinas Iniciais (Seeders)

1. **Engenharia da Computação** (Faculdade de Computação e Telecomunicações - `FCT`):
   - `EC0001` - Introdução à Engenharia da Computação (60h)
   - `EC0002` - Circuitos Lógicos e Eletrônica Digital (90h)
   - `EC0003` - Sistemas Embarcados e Arquitetura (90h)

2. **Engenharia Elétrica** (Instituto de Tecnologia - `ITEC`):
   - `EE0001` - Circuitos Elétricos I (90h)
   - `EE0002` - Sistemas de Energia e Potência (90h)

---

# 🚀 Como Executar o Projeto Localmente

Siga o passo a passo abaixo para configurar e executar a aplicação em seu ambiente local do zero.

---

### 1. Clonar o Repositório
```bash
git clone <URL_DO_REPOSITORIO>
cd sistema-ppc
```

---

### 2. Configurar Variáveis de Ambiente e Iniciar o Banco de Dados (MySQL 8.0)
Crie o arquivo de configuração `.env` a partir do exemplo e suba o contêiner do MySQL via Docker:

```bash
cp .env.example .env
docker-compose up -d db
```

> **Nota:** Certifique-se de ajustar as credenciais de banco no arquivo `.env` (como `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD`), se necessário.

---

### 3. Instalar Dependências (PHP e Node.js)
```bash
composer install
npm install
```

---

### 4. Preparar Pastas de Storage e Permissões
Crie a estrutura necessária para armazenar sessões, caches e views (evita erros de diretório ausente):

```bash
mkdir -p storage/framework/{sessions,views,cache}
chmod -R 775 storage bootstrap/cache
```

---

### 5. Gerar Chave da Aplicação, Rodar Migrações e Seeders
```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

---

### 6. Iniciar os Servidores (Backend e Frontend)

Abra **dois terminais separados** no diretório raiz do projeto:

* **Terminal 1 — Backend (Laravel):**
  ```bash
  php artisan serve
  ```

* **Terminal 2 — Frontend (Vue 3 / Vite):**
  ```bash
  npm run dev
  ```

---

### 🌐 Acesso à Aplicação

Acesse a aplicação no seu navegador através do endereço:  
👉 [http://localhost:8000](http://localhost:8000)

Acesse a aplicação no navegador em: **`http://localhost:8000`**

---

## 🛢️ Ferramentas Recomendadas para Visualizar o Banco de Dados

Para visualizar somente as tabelas e dados do MySQL de forma gráfica, recomenda-se usar:

1. **DBeaver** (Gratuito e Multiplataforma - **Altamente Recomendado**):
   - **Host**: `127.0.0.1` | **Porta**: `33060`
   - **Database**: `sistema_ppc`
   - **Usuário**: `ppc_user` | **Senha**: `ppc_password`
   ```bash
   DB_HOST=127.0.0.1
   DB_PORT=33060
   DB_DATABASE=sistema_ppc
   DB_USERNAME=ppc_user
   DB_PASSWORD=ppc_password
   ```
2. **VS Code Extension (Database Client / MySQL)**:
   - Permite visualizar o MySQL direto dentro do VS Code.
3. **MySQL Workbench**:
   - Ferramenta visual oficial da Oracle / MySQL.
