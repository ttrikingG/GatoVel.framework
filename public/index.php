<?php

// ============================================================
//                     FRONT CONTROLLER
// ============================================================

// Carrega bootstrap do framework
require "../bootstrap.php";

use app\nucleo\Controller;
use app\nucleo\Method;
use app\nucleo\Parameters;

/*
================================================================================
Fluxo do Front Controller:

  Controller
   - Detecta qual controller deve ser carregado com base na URI.
   - Usa Controller::load() para instanciar o controller correto.

  Method
   - Determina qual método do controller deve ser executado (ex: index, show).
   - Usa Method::load($controller) para validar se o método existe.

  Parameters
   - Recupera parâmetros da URI que podem ser passados para o método do controller.
   - Ex: /user/show/12 → parâmetro "12".

  Execução
   - Chama o método do controller passando os parâmetros obtidos.
================================================================================
*/

try {
    // Instancia e carrega o controller com base na URI
    $controller = new Controller;
    $controller = $controller->load();
    // dd($controller); // Descomente para debugar o controller instanciado

    // Instancia e carrega o método a ser executado
    $method = new Method;
    $method = $method->load($controller);
    // dd($method); // Descomente para debugar o método detectado

    // Instancia e carrega os parâmetros da URI
    $parameters = new Parameters;
    $parameters = $parameters->load();
    // dd($parameters); // Descomente para debugar os parâmetros

    // Executa o método do controller passando os parâmetros
    $controller->$method($parameters);

} catch (\Exception $e) {
    // Caso ocorra algum erro, exibe a mensagem de exceção
    dd($e->getMessage());
}

/*
================================================================================
RESUMO:

- Este arquivo atua como Front Controller do framework.
- Toda requisição passa por aqui.
- O fluxo é: URI → Controller → Método → Parâmetros → Execução.
- Função dd() pode ser usada para depuração.
================================================================================
*/
