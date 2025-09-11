<?php
// ============================================================
//                  BOOTSTRAP DO GATOVEL1
// ============================================================

// Inicializa sessão global da aplicação
session_start();

// Carrega o autoload do Composer
require "vendor/autoload.php";

use Dotenv\Dotenv;
use app\nucleo\protons\gears\Bind;
use app\nucleo\protons\gears\Connection;

// ============================================================
// Carrega variáveis de ambiente do .env
// - Todas as variáveis do .env ficam disponíveis em $_ENV
// - Ex: $_ENV['DB_HOST'], $_ENV['DB_DATABASE'], $_ENV['DB_CONNECTION']
// ============================================================
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ============================================================
// Cria a conexão PDO usando Connection::connect()
// - PDO configurado para o driver especificado no .env
// - Bindada no container para uso global
// ============================================================
Bind::bind('connection', Connection::connect());

// ============================================================
// Exemplo de teste de conexão com o banco de dados
// - Descomente este bloco para verificar se a conexão funciona
// - Não é necessário deixar ativo em produção
// ============================================================

/*
try {
    // Recupera a instância da conexão PDO do container Bind
    $db = Bind::get('connection');

    // Executa uma query simples para testar a conexão
    // "SELECT NOW()" retorna a data e hora atual do servidor do banco
    $stmt = $db->query("SELECT NOW() AS agora");

    // Recupera o resultado da query como objeto
    $resultado = $stmt->fetch();

    // Exibe a data e hora do banco, indicando que a conexão funcionou
    echo "Conexão funcionando! Agora: " . $resultado->agora;

} catch (\Exception $e) {
    // Captura qualquer erro de conexão ou execução da query e exibe a mensagem
    echo "Erro ao conectar: " . $e->getMessage();
}
*/

/*
================================================================================
RESUMO:

1. session_start() → inicia sessão global.
2. require "vendor/autoload.php" → carrega classes via Composer.
3. Dotenv → carrega variáveis do .env para $_ENV.
4. Connection::connect() → cria PDO conforme driver do .env.
5. Bind::bind('connection', PDO) → torna a conexão disponível globalmente.
6. Bloco de teste (descomentável) → verifica se a conexão PDO está funcionando.
================================================================================
*/
