<?php

namespace app\nucleo;

// ============================================================
//                    IMPORTAÇÕES NECESSÁRIAS
// ============================================================

// Classe para capturar a URI atual
use app\nucleo\protons\gears\Uri;

// Exception customizada para controller não encontrado
use app\nucleo\protons\gears\alerts\exceptions\ControllerNotExistException;

/**
 * ===========================================================
 *                        CLASSE CONTROLLER
 * ===========================================================
 * Responsável por:
 * Identificar a URI acessada
 * Determinar qual Controller deve ser carregado
 * Validar se o Controller existe
 * Instanciar e retornar o Controller correto
 */
class Controller
{
    // Guarda a URI atual
    private $uri;

    // Nome do controller identificado
    private $controller;

    // Namespace do controller encontrado
    private $namespace;

    // Lista de namespaces/pastas onde os controllers podem estar
    private $folders = [
        //"app\\nucleo\\protons\\controllers\\admin", // <- opcional para admin
        "app\\nucleo\\protons\\controllers\\site",   // <- ativo para site
    ];

    // ========================================================
    // Construtor
    // ========================================================
    public function __construct()
    {
        // Obtém a URI atual usando a classe Uri
        $this->uri = Uri::uri();
    }

    // ========================================================
    // Carrega o controller correto dependendo da URI
    // ========================================================
    public function load()
    {
        // Se a URI for "/", carrega o AppController
        if ($this->isHome()) {
            return $this->controllerHome();
        }

        // Caso contrário, carrega o controller baseado na URI
        return $this->controllerNotHome();
    }

    // ========================================================
    // Controller Home ("/")
    // ========================================================
    private function controllerHome()
    {
        // Verifica se AppController existe
        if (!$this->controllerExist('AppController')) {
            throw new ControllerNotExistException(
                "Esse controller não existe, por favor criar um Controller lá dentro de /controllers/..."
            );
        }

        // Instancia e retorna o controller
        return $this->instantiateController();
    }

    // ========================================================
    // Controller para URIs diferentes de "/"
    // ========================================================
    private function controllerNotHome()
    {
        // Obtém o nome do controller baseado na URI
        $controller = $this->getControllerNotHome();

        // Verifica se o controller existe
        if (!$this->controllerExist($controller)) {
            throw new ControllerNotExistException(
                "Esse controller não existe, por favor criar um Controller lá dentro de /controllers/..."
            );
        }

        // Instancia e retorna o controller
        return $this->instantiateController();
    }

    // ========================================================
    // Retorna o nome do Controller baseado na URI
    // Exemplo:
    //   /produtos       => ProdutosController
    //   /blog/post      => BlogController
    // ========================================================
    private function getControllerNotHome()
    {
        // Se a URI tiver mais de uma barra (ex: /blog/post/123)
        if (substr_count($this->uri, '/') > 1) {
            // Pega apenas a primeira parte da URI (blog, produtos, etc.)
            list($controller) = array_values(array_filter(explode('/', $this->uri)));
            return ucfirst($controller) . 'Controller';
        }

        // Caso simples (ex: /produtos)
        return ucfirst(ltrim($this->uri, '/')) . 'Controller';
    }

    // ========================================================
    // Verifica se a URI é a Home ("/")
    // ========================================================
    private function isHome()
    {
        return ($this->uri == '/');
    }

    // ========================================================
    // Verifica se o Controller existe nas pastas definidas
    // ========================================================
    private function controllerExist($controller)
    {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            // Se a classe existir no namespace
            if (class_exists($folder . '\\' . $controller)) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;
    }

    // ========================================================
    // Instancia e retorna o Controller encontrado
    // ========================================================
    private function instantiateController()
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return new $controller;
    }
}

/*
================================================================================
RESUMO:

- $this->uri → captura a URI atual.
- $this->folders → define onde procurar os controllers.
- load() → carrega o controller correto (Home ou outro).
- controllerExist() → verifica se o controller existe e seta namespace.
- instantiateController() → instancia e retorna o controller final.
- Exceções são lançadas se o controller não for encontrado.
================================================================================
*/
