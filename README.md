# 🎬 Projeto Controle Series

Sistema desenvolvido em Laravel para gerenciamento de séries, temporadas e episódios.

## 📋 Sobre o Projeto

O Projeto Controle Series é uma aplicação web desenvolvida com Laravel que permite o cadastro e gerenciamento de séries, suas temporadas e respectivos episódios.

O objetivo do projeto é praticar conceitos fundamentais do framework Laravel, incluindo:

* Migrations
* Eloquent ORM
* Relacionamentos entre entidades
* Controllers
* Blade Templates
* Rotas
* Form Requests
* Banco de Dados MySQL

---

## 🚀 Funcionalidades

### Séries

* ✅ Listar séries cadastradas
* ✅ Cadastrar nova série
* ✅ Excluir série
* ✅ Ordenação automática das séries

### Temporadas

* ✅ Listar temporadas de uma série
* ✅ Associação de temporadas à série

### Episódios

* ✅ Cadastro automático de episódios
* ✅ Associação de episódios às temporadas

---

## 🏗️ Estrutura do Projeto

### Entidades

#### Série

```text
Série
 ├── Temporada 1
 │    ├── Episódio 1
 │    ├── Episódio 2
 │    └── ...
 ├── Temporada 2
 └── ...
```

### Relacionamentos

```php
Serie
    hasMany(Season)

Season
    belongsTo(Serie)
    hasMany(Episode)

Episode
    belongsTo(Season)
```

---

## 🛠️ Tecnologias Utilizadas

* PHP 8+
* Laravel 12
* MySQL
* Bootstrap 5
* Blade Templates
* Composer

---

## 📦 Instalação

### Clonar o repositório

```bash
git clone https://github.com/filipe-csilva/Projeto-Controle-Series.git
```

### Entrar na pasta do projeto

```bash
cd Projeto-Controle-Series
```

### Instalar dependências

```bash
composer install
```

### Configurar ambiente

```bash
cp .env.example .env
```

### Gerar chave da aplicação

```bash
php artisan key:generate
```

### Configurar banco de dados

Edite o arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ControleSeries
DB_USERNAME=root
DB_PASSWORD=
```

### Executar migrations

```bash
php artisan migrate
```

### Iniciar servidor

```bash
php artisan serve
```

Acesse:

```text
http://localhost:8000
```

---

## 📁 Estrutura de Pastas

```text
app/
├── Http/
├── Models/

database/
├── migrations/

resources/
├── views/

routes/
├── web.php
```

---

## 🎯 Objetivos de Aprendizado

Este projeto foi desenvolvido com foco em:

* Relacionamentos One-to-Many
* Eloquent ORM
* Migrations
* Blade Components
* Organização MVC
* Boas práticas com Laravel

---

## 👨‍💻 Autor

**Filipe Silva**

* GitHub: https://github.com/filipe-csilva
* LinkedIn: [www.linkedin.com/in/filipe-paulo-da-silva](http://www.linkedin.com/in/filipe-paulo-da-silva)

---

## 📄 Licença

Este projeto foi desenvolvido para fins de estudo e aprendizado utilizando o framework Laravel.
