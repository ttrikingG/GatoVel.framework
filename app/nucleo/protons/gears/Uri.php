<?php

namespace app\nucleo\protons\gears;

/**
 * ===========================================================
 *                           CLASSE URI
 * ===========================================================
 * Responsável por:
 * Capturar a URI atual da requisição
 * Retornar apenas o path da URL, sem query strings ou hash
 *
 * Exemplo de uso:
 *   URL: http://localhost/produto/listar/10?order=desc
 *   Uri::uri() => "/produto/listar/10"
 */
class Uri
{
    // ========================================================
    // Método principal para capturar a URI
    // ========================================================
    /**
     * Retorna o caminho (path) da URI atual
     *
     * @return string Caminho da URI (ex: "/produto/listar/10")
     */
    public static function uri()
    {
        // $_SERVER["REQUEST_URI"] contém o path + query string
        // parse_url(..., PHP_URL_PATH) retorna somente o path
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }
}

/*
================================================================================
RESUMO:

- Uri::uri() → captura a URI atual da requisição.
- Retorna apenas o caminho (path), sem parâmetros GET.
- Exemplo:
    URL: http://localhost/produto/listar/10?order=desc
    Resultado: "/produto/listar/10"
================================================================================
*/
