<?php
namespace app\nucleo\protons\gears;

/**
 * ===========================================================
 *                           CLASSE BIND
 * ===========================================================
 * Container simples para armazenar instâncias globais do framework.
 *
 * Permite:
 * Bindar (registrar) instâncias ou valores com uma chave
 * Recuperar instâncias de qualquer lugar do framework
 *
 * Exemplo de uso:
 *   Bind::bind('connection', $pdo);
 *   $db = Bind::get('connection');
 *
 * ⚠️ Observação:
 *   - Não é singleton completo, mas garante que a mesma instância
 *     possa ser acessada globalmente pelo array interno.
 */
class Bind
{
    // Array interno que armazena as instâncias bindadas
    private static $bind = [];

    // ========================================================
    // Registra uma instância ou valor no container
    // ========================================================
    /**
     * Bind uma instância ou valor a uma chave
     *
     * @param string $key Chave para armazenar
     * @param mixed $value Instância ou valor
     */
    public static function bind($key, $value)
    {
        static::$bind[$key] = $value;
    }

    // ========================================================
    // Recupera uma instância ou valor do container
    // ========================================================
    /**
     * Recupera a instância/valor bindado pela chave
     *
     * @param string $key Chave da instância
     * @return mixed Instância ou valor
     * @throws \Exception Se a chave não existir
     */
    public static function get($key)
    {
        if (!isset(static::$bind[$key])) {
            throw new \Exception("Nenhum binding encontrado para a chave: {$key}");
        }
        return static::$bind[$key];
    }
}

/*
================================================================================
RESUMO:

- Bind::bind($key, $value)
  - Armazena qualquer instância ou valor globalmente acessível
  - $key: chave identificadora
  - $value: instância/valor a ser armazenado

- Bind::get($key)
  - Recupera a instância/valor armazenado
  - Lança exceção se não houver nenhum binding para a chave

Exemplo:
1. Bind::bind('connection', Connection::connect());
2. $db = Bind::get('connection'); // PDO disponível globalmente
================================================================================
*/
