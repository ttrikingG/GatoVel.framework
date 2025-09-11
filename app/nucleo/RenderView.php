<?php

namespace app\nucleo;

/**
 * ===========================================================
 *                       CLASSE RENDERVIEW
 * ===========================================================
 * Responsável por:
 * Carregar views do sistema
 * Injetar dados passados via array para dentro da view
 * Lançar exceção caso a view não exista
 *
 * Exemplo de uso:
 *   RenderView::render('site.home', ['title' => 'Bem-vindo']);
 *   => Carrega o arquivo ../app/eletrons/views/site/home.php
 *   => Disponibiliza a variável $title na view
 */
class RenderView
{
    // ========================================================
    // Método principal para renderizar uma view
    // ========================================================
    /**
     * @param string $view Caminho da view usando ponto como separador (ex: 'site.home')
     * @param array $data Array de dados que serão extraídos como variáveis na view
     * @throws \Exception Se a view não for encontrada
     */
    public static function render($view, $data = [])
    {
        // Converte o nome da view de 'site.home' para caminho físico
        // ../app/eletrons/views/site/home.php
        $viewFile = "../app/eletrons/views/" . str_replace('.', '/', $view) . '.php';
        
        // Verifica se o arquivo da view existe
        if (file_exists($viewFile)) {
            // Extrai o array $data em variáveis individuais
            // Ex: ['title' => 'Bem-vindo'] => $title disponível na view
            extract($data);

            // Inclui o arquivo da view
            require $viewFile;
        } else {
            // Se não existir, lança uma exceção detalhando a view que não foi encontrada
            throw new \Exception("View not found: {$view}");
        }
    }
}

/*
================================================================================
RESUMO:

- RenderView::render($view, $data)
  - $view: caminho da view no formato 'pasta.arquivo'
  - $data: array associativo de dados que serão disponibilizados na view
  - Extrai automaticamente os dados em variáveis
  - Lança exceção se a view não for encontrada

Exemplo de fluxo:
1. RenderView::render('site.home', ['title' => 'Bem-vindo']);
2. Converte para ../app/eletrons/views/site/home.php
3. Extrai ['title' => 'Bem-vindo'] como $title
4. Inclui o arquivo da view no fluxo atual
================================================================================
*/
