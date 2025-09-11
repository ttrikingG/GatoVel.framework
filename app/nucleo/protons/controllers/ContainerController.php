<?php

namespace app\nucleo\protons\controllers;

// Importa a trait View, que fornece métodos de renderização de views
use app\nucleo\neutrons\traits\View;

/**
 * ===========================================================
 *                 CONTROLLER: ContainerController
 * ===========================================================
 * Classe base/container para controllers que precisam renderizar views.
 *
 * Funcionalidade principal:
 *  - Fornecer os métodos da trait View:
 *      - view()       -> Renderiza qualquer view simples
 *      - contentView() -> Renderiza a página completa (master + conteúdo + footer)
 *
 * Uso típico:
 *  - Herda de ContainerController quando um controller precisa apenas
 *    de renderização de views sem lógica extra.
 *
 * Exemplo:
 *   $controller = new ContainerController();
 *   $controller->contentView('site.home', ['title'=>'Página Inicial']);
 */
class ContainerController
{
    // Injeta os métodos de renderização de views
    use View;

    // Nenhum método adicional por enquanto
}
