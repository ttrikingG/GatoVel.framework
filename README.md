# GatoVel.framework

Um framework PHP customizado para desenvolvimento rápido de aplicações web, com suporte a MVC, integração com Composer e organização modular de código.

---

## 📁 Estrutura do Projeto
GatoVel.framework/
│
├─ app/
│ ├─ nucleo/
│ │ ├─ protons/ # Módulo de funcionalidades relacionadas a controllers e Exiliares do sistema
│ │ └─ neutrons/ # Módulo de funcionalidades relacionadas a models
│ └─ electrons/ # Módulo de funcionalidades relacionadas a views
├─ public/ # Arquivos públicos (index.php, CSS, JS, imagens)
├─ vendor/ # Dependências do Composer (ignorado pelo Git)
├─ bootstrap.php # Inicialização da aplicação
├─ composer.json # Gerenciamento de dependências
├─ composer.lock # Versão exata das dependências
└─ .env # Configurações de ambiente (ignorado pelo Git)

---

## ⚙️ Instalação

1. Clone o repositório:
```bash
git clone https://github.com/ttrikingG/el-gatoVel.framework.git
cd el-gatoVel.framework

2.Instale as dependências do Composer:
composer install

3.Configure as variáveis de ambiente:

Copie o arquivo .env.example (ou crie .env) e configure suas credenciais de banco de dados, URLs, etc.

4.Inicie o servidor de desenvolvimento:
php -S localhost:8000 -t public/

✨ Funcionalidades

Estrutura MVC organizada

Modularidade para controllers e models

Integração com Composer

Suporte a arquivos de configuração via .env

Pasta public pronta para assets (JS, CSS, imagens)

🛠️ Uso

Coloque seus controllers em app/nucleo/protons/Controllers/

Coloque seus models em app/nucleo/neutrons/Models/

Configure rotas e inicialização no bootstrap.php
