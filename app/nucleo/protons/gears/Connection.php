<?php
namespace app\nucleo\protons\gears;

use PDO;

/**
 * ===========================================================
 *                       CLASSE CONNECTION
 * ===========================================================
 * Responsável por:
 * Criar a conexão PDO com o banco de dados
 * Suportar múltiplos drivers: MySQL, PostgreSQL e SQLite
 * Configurar atributos padrão do PDO
 *
 * O driver e credenciais são lidos do arquivo .env:
 *   - DB_CONNECTION
 *   - DB_HOST / DB_PORT / DB_DATABASE
 *   - DB_USERNAME / DB_PASSWORD
 *   - DB_SQLITE_PATH (apenas para SQLite)
 *
 * Exemplo de uso:
 *   $pdo = Connection::connect();
 *   $stmt = $pdo->query("SELECT NOW() AS agora");
 */
class Connection
{
    // ========================================================
    // Método principal para criar a conexão PDO
    // ========================================================
    /**
     * @return PDO Instância PDO conectada ao banco
     * @throws \Exception Se o driver não for suportado
     */
    public static function connect(): PDO
    {
        // Lê o driver do banco a partir do .env, padrão mysql
        $driver = $_ENV['DB_CONNECTION'] ?? 'mysql';

        switch ($driver) {
            case 'mysql':
                // DSN (Data Source Name) para MySQL
                $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8mb4";
                $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                break;

            case 'pgsql':
                // DSN para PostgreSQL
                $dsn = "pgsql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}";
                $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                break;

            case 'sqlite':
                // DSN para SQLite (caminho do arquivo)
                $dsn = "sqlite:{$_ENV['DB_SQLITE_PATH']}";
                $pdo = new PDO($dsn);
                break;

            default:
                // Se o driver não for suportado, lança exceção
                throw new \Exception("Driver não suportado: {$driver}");
        }

        // Configurações do PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Lança exceções em caso de erro
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Retorna objetos por padrão

        return $pdo;
    }
}

/*
================================================================================
RESUMO:

- Connection::connect()
  - Conecta ao banco conforme o driver definido em .env
  - Suporta MySQL, PostgreSQL e SQLite
  - Configura PDO para lançar exceções e retornar FETCH_OBJ
  - Lê credenciais diretamente do .env:
      - MySQL/PostgreSQL: host, port, database, username, password
      - SQLite: caminho do arquivo
================================================================================
*/
