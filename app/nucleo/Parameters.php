<?php

namespace app\nucleo;

// ============================================================
//                    IMPORTAÇÕES NECESSÁRIAS
// ============================================================

// Classe para capturar a URI atual
use app\nucleo\protons\gears\Uri;

/**
 * ===========================================================
 *                       CLASSE PARAMETERS
 * ===========================================================
 * Responsável por:
 * Extrair parâmetros adicionais da URI (após controller e método)
 * Retornar o parâmetro principal e o próximo, se existir
 *
 * Exemplo de URIs:
 *   /produto/listar/10           => parâmetro = 10
 *   /blog/post/123/comentarios   => parâmetro = 123, próximo = comentarios
 */
class Parameters
{
    // Guarda a URI atual
    private $uri;

    // ========================================================
    // Construtor
    // ========================================================
    public function __construct()
    {
        // Obtém a URI atual usando a classe Uri
        $this->uri = Uri::uri();
    }

    // ========================================================
    // Carrega os parâmetros extraídos da URI
    // ========================================================
    /**
     * @return object|null Retorna objeto com "parameter" e "next", ou null se não houver parâmetros
     */
    public function load()
    {
        return $this->getParameter();
    }

    // ========================================================
    // Extrai o parâmetro principal e o próximo
    // ========================================================
    /**
     * - Padrão de URI esperado: /controller/method/param1/param2...
     * - Se houver pelo menos 3 segmentos, retorna param1 como "parameter" e param2 como "next"
     * - Usa strip_tags() para sanitizar entradas contra XSS
     *
     * @return object|null
     */
    private function getParameter()
    {
        if (substr_count($this->uri, '/') > 2) {
            // Divide a URI em partes filtrando valores vazios
            $parameter = array_values(array_filter(explode('/', $this->uri)));

            return (object)[
                "parameter" => strip_tags($parameter[2]),                // Primeiro parâmetro extraído
                "next"      => strip_tags($this->getNextParamenter(2))   // Próximo parâmetro, se existir
            ];
        }

        // Retorna null se não houver parâmetros extras
        return null;
    }

    // ========================================================
    // Retorna o próximo parâmetro baseado na posição atual
    // ========================================================
    /**
     * @param int $actual Índice do parâmetro atual (ex: 2 para o primeiro após método)
     * @return string Próximo parâmetro ou o mesmo se não houver próximo
     */
    private function getNextParamenter($actual)
    {
        $parameter = array_values(array_filter(explode('/', $this->uri)));

        // Retorna próximo parâmetro ou o mesmo se não existir
        return $parameter[$actual + 1] ?? $parameter[$actual];
    }
}

/*
================================================================================
RESUMO:

- $this->uri → captura a URI atual.
- load() → retorna um objeto com "parameter" e "next" ou null.
- getParameter() → extrai os parâmetros extras após controller e método.
- getNextParamenter() → retorna o próximo parâmetro, se existir.
- Sanitização com strip_tags() evita ataques XSS.
================================================================================
*/
