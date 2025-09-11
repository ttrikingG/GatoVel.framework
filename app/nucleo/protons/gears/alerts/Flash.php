<?php 

namespace app\nucleo\protons\gears\alerts;

/**
 * ===========================================================
 *                      CLASSE: Flash
 * ===========================================================
 * Gerencia mensagens temporárias de sessão (flash messages).
 *
 * Uso típico:
 *  - Mensagens de sucesso, erro ou alerta que desaparecem após exibidas
 *  - Ex.: após redirecionar um formulário, mostrar feedback ao usuário
 *
 * Exemplo de fluxo:
 *  Flash::add(['success' => 'Cadastro realizado!']);
 *  echo Flash::get('success'); // Mostra a mensagem e remove da sessão
 */
class Flash
{
    /**
     * Adiciona mensagens de flash à sessão
     *
     * @param array $messages Array associativo: chave => mensagem
     * 
     * ⚠️ Observação:
     * - Não sobrescreve mensagens existentes com a mesma chave
     */
    public static function add($messages)
    {
        foreach($messages as $key => $message){
            if(!isset($_SESSION['flash'][$key])){
                $_SESSION['flash'][$key] = $message;
            }
        }
    }

    /**
     * Recupera a mensagem flash de uma chave específica
     * e remove da sessão após o acesso
     *
     * @param string $index Chave da mensagem
     * @return string HTML formatado da mensagem
     *
     * ⚠️ Observação:
     * - Chamar get() consome a mensagem. Ela não estará mais disponível
     *   para futuras chamadas.
     */
    public static function get($index)
    {
        if(isset($_SESSION['flash'][$index])){
            $messages = $_SESSION['flash'][$index];
            unset($_SESSION['flash'][$index]);
            return isset($messages) ? static::getMessage($messages) : '';
        }
        return '';
    }

    /**
     * Determina se a mensagem é única ou múltipla
     * e chama a função adequada para formatar
     *
     * @param mixed $messages String ou array de mensagens
     * @return string HTML
     */
    private static function getMessage($messages)
    {
        if(!is_array($messages)){
            return static::singleMessage($messages);
        }

        return static::multipleMessage($messages);
    }

    /**
     * Formata uma única mensagem como HTML
     *
     * @param string $message
     * @return string HTML
     */
    private static function singleMessage($message)
    {
        return '<span>'.$message.'</span>';
    }

    /**
     * Formata múltiplas mensagens como HTML
     *
     * @param array $messages
     * @return string HTML
     */
    private static function multipleMessage($messages)
    {
        $list = '<p>';
        foreach ($messages as $message) {
            $list .= '<b>' . $message . '</b>';
        }
        $list .= '</p>';

        return $list;  // Retorna a string HTML sem imprimir
    }
}

/*
================================================================================
RESUMO:

- Flash::add($messages)
    Adiciona mensagens temporárias à sessão, sem sobrescrever existentes.

- Flash::get($index)
    Recupera e remove a mensagem da sessão, retornando HTML.

- getMessage(), singleMessage(), multipleMessage()
    Funções auxiliares internas para formatação de mensagens.

⚠️ Dica:
- Útil para feedback de formulários, erros e confirmações de usuário.
- Não deixa mensagens persistirem após exibidas.
================================================================================
*/
