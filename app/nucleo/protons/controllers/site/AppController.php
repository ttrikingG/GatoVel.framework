<?php

namespace app\nucleo\protons\controllers\site;

use app\nucleo\protons\controllers\ContainerController;

/**
 * ===========================================================
 *                     CONTROLLER: AppController
 * ===========================================================
 * Controlador responsável pela página inicial do site.
 * 
 * Herda de:
 *   - ContainerController
 *       -> Disponibiliza os métodos view() e contentView() via trait View
 *
 * Uso:
 *   - Quando a URI for "/", este controller será carregado.
 *   - O método index() é chamado automaticamente como padrão.
 *
 * Exemplo de rota:
 *   /             => AppController@index()
 * 
 * Este controller serve como ponto inicial do site, exibindo a view de boas-vindas.
 * 
 * ===========================================================
 * OBSERVAÇÃO:
 *   - Este é o lugar ideal para adicionar outros métodos
 *     relacionados ao recurso principal da controller:
 *       - store()
 *       - show()
 *       - edit()
 *       - update()
 *       - delete()
 *   - Todos os métodos adicionados aqui poderão ser chamados via URI,
 *     seguindo o padrão: /controller/method/parametros
 */
class AppController extends ContainerController
{
    /**
     * Método principal da Home ("/")
     *
     * Responsável por:
     *  - Renderizar a view de boas-vindas
     *  - Injetar o título da página
     */
    public function index()
    {
        // Chama contentView herdado da trait View
        // Parâmetros:
        //   1. 'site.wellcome' -> caminho da view de conteúdo
        //   2. []               -> dados adicionais para a view (nenhum neste caso)
        //   3. 'site'           -> prefixo da master (layout principal)
        //   4. 'Bem-vindo à minha página' -> título da página, disponível na master
        $this->contentView('site.wellcome', [], 'site', 'Bem-vindo ao Gatovel');
    }

    // =======================================================
    // Aqui você pode adicionar outros métodos, por exemplo:
    // public function store()  { ... }
    // public function show()   { ... }
    // public function edit()   { ... }
    // public function update() { ... }
    // public function delete() { ... }
    // =======================================================
}
