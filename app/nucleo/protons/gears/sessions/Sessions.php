<?php

namespace app\nucleo\protons\gears\sessions;

/**
 * ===========================================================
 *                     CLASSE: Sessions
 * ===========================================================
 * Responsável por gerenciar sessões de usuários e administradores.
 *
 * Funcionalidades principais:
 *  - startUsersSession($user, $model) -> Cria a sessão do usuário
 *  - logout()                        -> Encerra a sessão do usuário/admin logado
 *
 * Obs:
 *  - Usa $_SESSION do PHP para armazenar dados.
 *  - Regenera o ID da sessão para maior segurança.
 *  - Redireciona para a home após logout.
 */
class Sessions
{   
    /**
     * Inicia a sessão do usuário
     *
     * @param object $user  Objeto contendo dados do usuário (ex: id, firstName, lastName)
     * @param object $model Objeto contendo informações de chave da sessão (ex: $model->session)
     * @return bool Retorna true se a sessão foi criada com sucesso
     *
     * Exemplo:
     *   Sessions::startUsersSession($user, $model);
     */
    public static function startUsersSession($user, $model): bool
    {
        // Define que o usuário está logado
        $_SESSION[$model->session]   = true;

        // Armazena o ID do usuário
        $_SESSION[$model->user_id]   = $user->id;

        // Armazena o nome completo do usuário
        $_SESSION[$model->user_name] = trim($user->firstName . ' ' . $user->lastName);

        // Regenera o ID da sessão para prevenir ataques de session fixation
        session_regenerate_id(true);

        return true;
    }

    /**
     * Encerra a sessão do usuário ou administrador logado
     *
     * - Remove os dados da sessão correspondentes
     * - Regenera o ID da sessão
     * - Redireciona para a página inicial
     *
     * Exemplo:
     *   Sessions::logout();
     */
    public static function logout()
    {
        // Remove apenas os dados do usuário logado
        if (isset($_SESSION['user_logged'])) {
            unset($_SESSION['user_logged'], $_SESSION['user_name'], $_SESSION['user_id']);
        }

        // Remove apenas os dados do admin logado
        if (isset($_SESSION['admin_logged'])) {
            unset($_SESSION['admin_logged'], $_SESSION['admin_name'], $_SESSION['admin_id']);
        }

        // Regenera o ID da sessão por segurança
        session_regenerate_id(true);

        // Redireciona para a página inicial
        redirect('/');
    }
}

/*
================================================================================
RESUMO:

1. startUsersSession($user, $model)
   - Cria a sessão do usuário com dados essenciais (ID, nome, flag de login)
   - Regenera ID da sessão para segurança

2. logout()
   - Remove dados da sessão do usuário/admin
   - Regenera ID da sessão
   - Redireciona para a home

⚠️ Dicas:
- Sempre chame startUsersSession após autenticação válida.
- logout deve ser usado ao encerrar a sessão para evitar dados residuais.
================================================================================
*/
