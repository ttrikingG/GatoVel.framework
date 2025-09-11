# GatoVel.framework 🚀

![PHP](https://img.shields.io/badge/PHP-8.4-blue)
![Composer](https://img.shields.io/badge/Composer-v2.6-blue)
![License](https://img.shields.io/badge/License-MIT-green)

Framework PHP customizado para desenvolvimento de aplicações web, organizado em módulos, com suporte a MVC, Composer e configuração via `.env`.# GatoVel.framework
├─ vendor/ # Dependências do Composer (ignorado pelo Git)
├─ bootstrap.php # Inicialização da aplicação
├─ composer.json # Gerenciamento de dependências
├─ composer.lock # Versão exata das dependências
└─ .env # Configurações de ambiente (ignorado pelo Git)

---

## ⚙️ Instalação
Copie e cole os comandos abaixo para configurar o projeto:

```bash
# 1. Clonar o repositório
git clone https://github.com/ttrikingG/el-gatoVel.framework.git
cd el-gatoVel.framework

# 2. Instalar dependências do Composer
composer install

# 3. Configurar variáveis de ambiente
# Copie o arquivo .env.example ou crie .env
# e configure suas credenciais de banco de dados, URLs, etc.

# 4. Iniciar o servidor de desenvolvimento
php -S localhost:8000 -t public/
# Gatovel Framework

**GatoVel** é um framework em php moderno, estilizado com temática pixel art e inspirado em estética retro gaming. Ele traz uma experiência visual única, com animações suaves, tipografia customizada e design responsivo.

---

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

## Tecnologias usadas

- HTML5
- CSS3 (Flexbox, Grid, Animações, Gradientes)
- JavaScript (DOM manipulation para smooth scroll, parallax e efeito glitch)
- Fonte Orbitron do Google Fonts

---

## Estrutura do Projeto


Contém toda a estrutura e estilos em `<style>` embutido.

---

## Como executar

1. Salve o arquivo como `index.html` (ou `.php` se usar PHP).
2. Abra em um navegador moderno (Chrome, Firefox, Edge, Safari).
3. Navegue pela página para ver os efeitos de animação e navegação suave.

---

## Próximos passos

- Externalizar o CSS e JS para arquivos separados para melhor manutenção.
- Criar componentes reutilizáveis.
- Adicionar interatividade avançada com frameworks JS.

---

## Licença

MIT © 2025 GatoVel Framework

---



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
Copie e cole os comandos abaixo para configurar o projeto:

```bash
# 1. Clonar o repositório
git clone https://github.com/ttrikingG/el-gatoVel.framework.git
cd el-gatoVel.framework

# 2. Instalar dependências do Composer
composer install

# 3. Configurar variáveis de ambiente
# Copie o arquivo .env.example ou crie .env
# e configure suas credenciais de banco de dados, URLs, etc.

# 4. Iniciar o servidor de desenvolvimento
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
