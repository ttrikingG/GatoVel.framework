<?php

namespace app\nucleo\neutrons\traits;

// Importa a classe RenderView do namespace app\nucleo
use app\nucleo\RenderView;

/**
 * ===========================================================
 *                     TRAIT: View
 * ===========================================================
 * Responsável por renderizar views dentro do framework.
 *
 * Funcionalidades:
 *  - view()       -> Renderiza qualquer view passando dados
 *  - contentView() -> Renderiza a página completa (master + conteúdo)
 *
 * Observações:
 *  - Permite organizar master, header, conteúdo e footer de forma estruturada.
 *  - Mantém a ordem de renderização para evitar erros de scripts JS.
 */
trait View
{
    /**
     * Renderiza uma view simples, injetando dados nela.
     *
     * @param array $data Array associativo de dados que serão extraídos como variáveis
     * @param string $view Caminho da view no formato 'pasta.arquivo'
     *
     * Exemplo:
     *   $this->view(['title'=>'Bem-vindo'], 'site.home');
     */
    public function view(array $data, string $view)
    {
        // Chama a classe RenderView para carregar a view
        RenderView::render($view, $data);
    }

    /**
     * Renderiza a página completa: master + conteúdo + footer
     *
     * @param string $contentView Caminho da view de conteúdo (ex: 'site.home')
     * @param array $data Dados que serão injetados na master e na view de conteúdo
     * @param string $prefix Prefixo da master (ex: 'site')
     * @param string $title Título da página, disponível na master
     *
     * Exemplo de uso:
     *   $this->contentView('site.home', ['user'=>$user], 'site', 'Página Inicial');
     *
     * ⚠️ ORDEM DE RENDERIZAÇÃO IMPORTANTE:
     * -------------------------------------
     * 1. Master: define a estrutura principal do HTML.
     * 2. Header (opcional): carregado antes do conteúdo.
     * 3. ContentView: conteúdo específico da página.
     * 4. Footer (opcional): scripts JS devem ser incluídos aqui.
     *
     * Nunca altere a sequência para não quebrar a renderização.
     */
    public function contentView(string $contentView, array $data = [], string $prefix = 'site', string $title = '')
    {
        // Adiciona título ao array de dados
        $data['title'] = $title;

        // -----------------------------
        // Renderiza a master (layout principal)
        // -----------------------------
        $this->view($data, "{$prefix}.master");

        // -----------------------------
        // Header opcional
        // -----------------------------
        // $this->view([], "{$prefix}.header"); 
        // - Se utilizar um header separado, carregue aqui.
        // - Recebe as mesmas variáveis de $data.

        // -----------------------------
        // Renderiza a view de conteúdo
        // -----------------------------
        $this->view($data, $contentView);

        // -----------------------------
        // Footer opcional
        // -----------------------------
        // $this->view([], "{$prefix}.footer"); 
        // - Importante: scripts JS dependentes do DOM devem ser incluídos aqui.
        // - Não remova este footer se houver manipulação de elementos HTML.
    }
}

/*
================================================================================
RESUMO:

1. $this->view($data, $view)
   - Renderiza qualquer view simples passando dados.
   - Extrai os dados como variáveis disponíveis na view.

2. $this->contentView($contentView, $data, $prefix, $title)
   - Renderiza a master, view de conteúdo e footer opcional.
   - Mantém a ordem correta para não quebrar scripts JS.
   - Permite passar título e dados para master e conteúdo.

DICA:
- Use contentView() para páginas completas.
- Use view() para partes isoladas ou partials.
================================================================================
*/
