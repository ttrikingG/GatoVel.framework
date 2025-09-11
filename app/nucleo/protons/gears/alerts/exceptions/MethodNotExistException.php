<?php

namespace app\nucleo\protons\gears\alerts\exceptions;

/**
 * ===========================================================
 *               EXCEÇÃO: MethodNotExistException
 * ===========================================================
 * Lançada quando o sistema tenta acessar um método dentro de um Controller
 * que não existe.
 *
 * Objetivo:
 * - Diferenciar erros de método inexistente de outras exceções
 * - Facilitar tratamento específico no framework
 *
 * Exemplo de uso:
 *   // URL: /produto/listar
 *   // ProdutoController existe, mas método listar() não
 *   throw new MethodNotExistException("Método não encontrado: listar no ProdutoController");
 *
 * Extende a classe nativa \Exception do PHP.
 */
class MethodNotExistException extends \Exception
{
    // Nenhuma lógica adicional no momento.
    // Apenas uma Exception customizada para diferenciar no fluxo.
}

/*
================================================================================
RESUMO:

- Indica que o método requisitado na URI não existe no controller
- Pode ser capturada separadamente para exibir mensagens customizadas
- Mantém o fluxo do framework organizado e claro
================================================================================
*/
