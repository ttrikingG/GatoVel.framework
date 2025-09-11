<?php

namespace app\nucleo\protons\gears;

/**
 * ===========================================================
 *                      CLASSE: Redirect
 * ===========================================================
 * Responsável por redirecionamentos de página dentro do framework.
 *
 * Funcionalidades principais:
 *  - Redirect::redirect($target) -> Redireciona para uma URL específica
 *  - Redirect::back()           -> Retorna para a página anterior
 *
 * Obs:
 *  - Usa header("Location: ...") do PHP
 *  - Deve ser chamado antes de qualquer saída HTML (echo, print, etc.)
 */
class Redirect
{
    /**
     * Redireciona para uma URL específica
     *
     * @param string $target URL ou caminho relativo para redirecionar
     * @return void
     *
     * Exemplo:
     *  Redirect::redirect('/home');
     */
    public static function redirect($target)
    {
        return header("Location:{$target}");
    }

    /**
     * Retorna para a página anterior
     *
     * @return void
     *
     * Funciona da seguinte forma:
     *  1. Se existir $_SERVER['HTTP_REFERER'], usa como destino
     *  2. Caso contrário, usa um fallback via JavaScript history.go(-1)
     *
     * Exemplo:
     *  Redirect::back();
     */
    public static function back()
    {
        // Fallback caso não exista referer
        $previous = "javascript:history.go(-1)";

        // Se o navegador enviar o HTTP_REFERER, utiliza ele
        if(isset($_SERVER['HTTP_REFERER'])){
            $previous = $_SERVER['HTTP_REFERER'];
        }

        return header("Location:{$previous}");
    }
}

/*
================================================================================
RESUMO:

- Redirect::redirect($target)
    Redireciona para qualquer URL ou rota do sistema.

- Redirect::back()
    Retorna para a página anterior, usando HTTP_REFERER se disponível,
    ou fallback JavaScript caso contrário.

⚠️ Dicas:
- Sempre chame antes de enviar qualquer saída para o navegador.
- Ideal para redirecionamentos após formulários ou validações.
================================================================================
*/
