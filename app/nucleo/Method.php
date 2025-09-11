<?php

namespace app\nucleo;

// ============================================================
//                    IMPORTAÇÕES NECESSÁRIAS
// ============================================================

// Classe para capturar a URI atual
use app\nucleo\protons\gears\Uri;

// Exception customizada para métodos inexistentes nos controllers
use app\nucleo\protons\gears\alerts\exceptions\MethodNotExistException;

/**
 * ===========================================================
 *                         CLASSE METHOD
 * ===========================================================
 * Responsável por:
 * Identificar qual método de um Controller deve ser chamado
 * Validar se esse método existe no Controller
 * Retornar o nome do método correto para execução
 */
class Method
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
    // Carrega o método a ser executado no controller
    // ========================================================
    /**
     * @param object $controller Instância do controller
     * @return string $method Nome do método que será chamado
     * @throws MethodNotExistException Caso o método não exista no controller
     */
    public function load($controller)
    {
        // Obtém o método com base na URI
        $method = $this->getMethod();

        // Valida se o método existe no controller
        if (!method_exists($controller, $method)) {
            throw new MethodNotExistException(
                "Esse method: {$method} não existe dentro dos controllers, criar ele dentro das funções dos /controllers/..."
            );
        }

        // Retorna o método válido
        return $method;
    }

    // ========================================================
    // Obtém o método da URI
    // ========================================================
    /**
     * Regras:
     * - Se a URI tiver mais de uma barra (ex: /produto/listar),
     *   pega a segunda parte (listar)
     * - Se não houver método, assume "index" como padrão
     *
     * Exemplos:
     *   /produto        => index
     *   /produto/listar => listar
     *   /blog/post/123  => post
     *
     * @return string Nome do método a ser chamado
     */
    private function getMethod()
    {
        // Se a URI tiver pelo menos 2 partes (controller/method)
        if (substr_count($this->uri, '/') > 1) {
            // Divide a URI por "/", filtra valores vazios e pega controller + método
            list($controller, $method) = array_values(array_filter(explode('/', $this->uri)));
            return $method;
        }

        // Retorna "index" como método padrão
        return 'index';
    }
}

/*
================================================================================
RESUMO:

- $this->uri → captura a URI atual.
- load($controller) → retorna o método correto do controller ou lança exceção.
- getMethod() → identifica o método baseado na URI, padrão "index".
- Lança MethodNotExistException se o método não existir.
================================================================================
*/
