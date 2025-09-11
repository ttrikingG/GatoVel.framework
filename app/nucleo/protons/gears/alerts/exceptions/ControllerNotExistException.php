<?php

namespace app\nucleo\protons\gears\alerts\exceptions;

/**
 * ===========================================================
 *               EXCEÇÃO: ControllerNotExistException
 * ===========================================================
 * Lançada quando o sistema tenta carregar um Controller que não existe.
 *
 * Objetivo:
 * - Diferenciar erros de Controller inexistente de outras exceções
 * - Facilitar tratamento específico no framework
 *
 * Exemplo de uso:
 *   // URL: /produto
 *   // ProdutoController não existe
 *   throw new ControllerNotExistException("Controller não encontrado: ProdutoController");
 *
 * Extende a classe nativa \Exception do PHP.
 */
class ControllerNotExistException extends \Exception
{
    // Nenhuma lógica adicional no momento.
    // Apenas uma Exception customizada para diferenciar no fluxo.
}

/*
================================================================================
RESUMO:

- Serve para indicar que o controller requisitado na URI não existe
- Pode ser capturada separadamente para exibir mensagens customizadas
- Mantém o fluxo do framework organizado e claro
================================================================================
*/
