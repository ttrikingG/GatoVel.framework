<?php

namespace app\nucleo\neutrons\traits;

use app\nucleo\neutrons\models\querybuilder\read\Select;

/**
 * Trait Searching
 * ----------------
 * Responsável por construir queries de busca dinâmicas com filtros.
 * 
 * Funcionalidades:
 *  - Recebe um termo de pesquisa via query string ($_GET['q'])
 *  - Permite buscar em múltiplas tabelas e colunas
 *  - Retorna a SQL gerada pelo query builder, sem executar
 * 
 * Observações:
 *  - Ideal para usar com AJAX ou paginação, onde a execução da query
 *    será feita separadamente.
 */
class Searching
{
    /**
     * Constrói a query de busca com filtros e retorna a SQL gerada.
     *
     * @return string SQL pronta, mas não executada
     */
    public function findWithFilters(): string
    {
        // Captura o termo de pesquisa da query string
        $term = $_GET['q'] ?? null;

        // Se não houver termo, retorna string vazia
        if (!$term) {
            return '';
        }

        // Define os targets (tabelas e colunas) para a busca
        $targets = [
            'tables' => [
                'title'       => 'title',       // coluna 'title' na tabela principal
                'description' => 'description', // coluna 'description' na tabela principal
            ],
            // Pode adicionar outras tabelas e colunas aqui
        ];

        // Cria o query builder Select
        $select = new Select();

        // Define as tabelas e colunas, e aplica o termo de busca
        $select->from($targets)->where($term);

        // Retorna a query SQL gerada sem executá-la
        return $select->sql();
    }
}
