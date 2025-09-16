# GatoVel.framework V1.0 🚀

![PHP](https://img.shields.io/badge/PHP-8.4-blue)
![Composer](https://img.shields.io/badge/Composer-v2.6-blue)
![License](https://img.shields.io/badge/License-MIT-green)

Framework PHP customizado para desenvolvimento de aplicações web, organizado em módulos, com suporte a MVC, Composer e configuração via `.env`.# GatoVel.framework
---

## 📁 Estrutura do Projeto

| Caminho                      | Tipo      | Descrição                                                   |
| :--------------------------- | :-------- | :---------------------------------------------------------- |
| `app/`                       | Pasta     | Contém todo o backend                                       |
| `app/nucleo/`                | Pasta     | Núcleo da aplicação e suas configurações                    |
| `app/nucleo/protons/`        | Pasta     | Funcionalidades relacionadas a controllers e auxiliares     |
| `app/nucleo/neutrons/`       | Pasta     | Funcionalidades relacionadas a models                       |
| `app/electrons/`             | Pasta     | Views do sistema                                            |
| `public/`                    | Pasta     | Arquivos públicos (index.php, CSS, JS, imagens)             |
| `vendor/`                    | Pasta     | Dependências do Composer (ignoradas pelo Git)               |
| `bootstrap.php`              | Arquivo   | Inicialização da aplicação                                  |
| `composer.json`              | Arquivo   | Gerenciamento de dependências                               |
| `composer.lock`              | Arquivo   | Versão exata das dependências                               |
| `.env`                       | Arquivo   | Configurações de ambiente (ignoradas pelo Git)              |


🛠️ Uso

Coloque seus controllers em app/nucleo/protons/Controllers/

Coloque seus models em app/nucleo/neutrons/Models/

**Não possui sistemas de rotas dinâmicas**

## ⚙️ Instalação
Copie e cole os comandos abaixo para configurar o projeto:

# 1. Clonar o repositório
```bash
git clone https://github.com/ttrikingG/el-gatoVel.framework.git
cd el-gatoVel.framework
``` 


# 2. Instalar dependências do Composer
```bash
composer install
``` 

# 3. Configurar variáveis de ambiente
# Copie o arquivo .env.example ou crie .env
# e configure suas credenciais de banco de dados, URLs, etc.

# 4. Iniciar o servidor de desenvolvimento
```bash
php -S localhost:8000 -t public/
```

# Gatovel Framework

**GatoVel** é um framework em php moderno, estilizado com temática pixel art e inspirado em estética retro gaming. Ele traz uma experiência visual única, com animações suaves, tipografia customizada e design responsivo.

---
