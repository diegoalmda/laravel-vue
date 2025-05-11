# 🎯 Objetivo

Implementar um sistema de postagens simples onde **somente usuários administradores** podem criar posts. O projeto usa **Laravel Sail** para ambiente de desenvolvimento com Docker (PHP 8+).

---

## 🧩 Tarefas

### Backend (Laravel)

- Criar a migration e modelo `Post` com os campos:
- - `title`
  - `content`
  - `user_id` (relacionamento com `User`)
- Criar as relações:
  - `User hasMany Posts`
  - `Post belongsTo User`
- Criar endpoints:
  - `POST /api/posts` → Criação de post (apenas para admin)
  - `GET /api/posts?user_id=1` → Listagem dos posts de um usuário
- Criar um seeder que adicione:
  - Um **usuário admin** (`admin@example.com` / `password`)
  - Um **usuário leitor** (`reader@example.com` / `password`)
- Apenas o admin pode criar posts.

### Frontend (Vue.js)

- Usar Vue 3 com Vite.
- Criar componente para:
  - **Formulário de criação de post** (visível apenas para admin)
  - **Listagem de posts**
- Utilizar **Axios** ou `fetch` para consumir a API.
- Estilizar com **TailwindCSS** ou **Bootstrap 5**.

---

## ⚠️ Importante

- A autenticação básica disponível via Breeze.
- O formulário de criação deve ser exibido **somente para o admin**.

---

## 🛠️ Tecnologias e Versões

| Ferramenta   | Versão                        |
| ------------ | ----------------------------- |
| Laravel      | 11.x                          |
| PHP          | 8.2+                          |
| Laravel Sail | latest                        |
| Vue.js       | 3.x                           |
| Vite         | latest                        |
| Tailwind CSS | 3.x (ou Bootstrap 5)          |
| Docker       | Recomendado: 20.x ou superior |

---

## 🚀 Como rodar o projeto com Sail (Docker)

### 1. Clone o repositório

```bash
cd test-laravel-vue
```

### 2. Suba os containers

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

./vendor/bin/sail up -d
```

### 3. Instale as dependências do frontend

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### 4. Rode as migrations e seeders

```bash
./vendor/bin/sail artisan migrate --seed
```

---

## 👥 Usuários de Teste

| Tipo   | Email              | Senha    |
| ------ | ------------------ | -------- |
| Admin  | admin@example.com  | password |
| Leitor | reader@example.com | password |
