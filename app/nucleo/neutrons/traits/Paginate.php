<?php

namespace app\nucleo\neutrons\traits;

/**
 * Trait Paginate
 * ----------------
 * Fornece funcionalidades de paginação para qualquer model ou lista de registros.
 * 
 * Funcionalidades:
 *  - Definir limite de registros por página
 *  - Calcular o offset automaticamente com base na página atual
 *  - Calcular o total de páginas
 *  - Renderizar links de paginação HTML estilizados
 * 
 * Observações:
 *  - Assumimos que a página atual vem via query string ($_GET['page'])
 *  - Links são gerados de forma inline e responsiva para navegação simples
 */
trait Paginate
{
    /** @var int Quantidade de registros por página */
    protected $limit = 10;

    /** @var int Deslocamento inicial para consulta SQL */
    protected $offset = 0;

    /** @var int Página atual */
    protected $currentPage;

    /** @var int Quantidade de links a exibir antes e depois da página atual */
    protected $linksPerPage = 5;

    /**
     * Define o limite de registros por página
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Define a página atual e calcula o offset para consultas
     *
     * @return $this
     */
    public function setCurrentPage()
    {
        // Recupera a página da query string ou assume 1 como padrão
        $this->currentPage = $_GET['page'] ?? 1;

        // Calcula o offset para uso em SQL
        $this->offset = ($this->currentPage - 1) * $this->limit;
        
        return $this;
    }

    /**
     * Calcula o total de páginas com base no total de registros
     *
     * @param int $total Total de registros
     * @return int Total de páginas
     */
    public function totalPages($total)
    {
        return ceil($total / $this->limit);
    }

    /**
     * Renderiza links de paginação em HTML
     *
     * @param int $totalRegisters Total de registros
     * @return string HTML dos links de paginação
     */
    public function renderLinks($totalRegisters)
    {
        $totalPages = $this->totalPages($totalRegisters);

        // Determina de onde iniciar os links
        $startLinks = 1;
        if ($this->currentPage > $this->linksPerPage) {
            $startLinks = $this->currentPage - $this->linksPerPage;
        }

        // Determina até onde os links devem ir
        $endLinks = $totalPages;
        if (($this->currentPage + $this->linksPerPage) < $totalPages) {
            $endLinks = $this->currentPage + $this->linksPerPage;
        }

        // Começo da lista de links
        $links = '<ul style="list-style-type: none; padding: 0; margin: 0; display: inline-flex;">';
        $active = $totalPages ? 'active' : '';

        // Estilo base e hover para links
        $baseStyle = "color: #239929ff; text-decoration: none; padding: 8px 16px; margin: 0 4px; transition: all 0.3s ease; font-weight: 500; border: 1px solid transparent;";
        $hoverStyle = "onmouseover=\"this.style.background='rgba(132, 204, 22, 0.2)'\" onmouseout=\"this.style.background='transparent'\"";

        // Link para primeira página e anterior
        if ($this->currentPage > 1) {
            $previusPage = $this->currentPage - 1;
            $links .= "<li><a style='{$baseStyle}' {$hoverStyle} href='?page=1' class='{$active}'>Init</a></li>";
            $links .= "<li><a style='{$baseStyle}' {$hoverStyle} href='?page={$previusPage}' class='{$active}'>&laquo;</a></li>";
        }

        // Links numéricos das páginas
        for ($i = $startLinks; $i <= $endLinks; $i++) {
            $active = $this->currentPage == $i ? 'active' : '';
            $bgActive = $active ? "background: rgba(132, 204, 22, 0.2);" : "";
            $links .= "<li><a style='{$baseStyle} {$bgActive}' {$hoverStyle} href='?page={$i}' class='{$active}'>{$i}</a></li>";
        }

        // Link para próxima página e última
        if ($this->currentPage < $totalPages) {
            $nextPage = $this->currentPage + 1;
            $links .= "<li><a style='{$baseStyle}' {$hoverStyle} href='?page={$nextPage}' class='{$active}'>&raquo;</a></li>";
            $links .= "<li><a style='{$baseStyle}' {$hoverStyle} href='?page={$totalPages}' class='{$active}'>End</a></li>";
        }

        $links .= '</ul>';

        return $links;
    }
}
