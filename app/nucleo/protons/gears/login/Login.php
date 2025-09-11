<?php

namespace app\nucleo\protons\gears\login;

use app\nucleo\protons\gears\sessions\Sessions;
use app\nucleo\neutrons\models\Model;

/**
 * ===========================================================
 *                     CLASSE: Login
 * ===========================================================
 * Responsável por autenticar usuários.
 *
 * Funcionalidades principais:
 *  - login(Model $model) -> Tenta autenticar um usuário
 *  - loggedIn()           -> Cria sessão do usuário logado
 *  - isNotLoggedIn()     -> Define mensagem de erro e redireciona
 *
 * Obs:
 *  - Usa a classe Sessions para gerenciar sessões.
 *  - Usa flash messages para informar erros de login.
 */
class Login
{
    private $model; // Model do banco de dados para o usuário
    private $user;  // Objeto do usuário encontrado

    /**
     * Realiza o login de um usuário
     *
     * @param Model $model Model referente à tabela/entidade de usuários
     * @return bool|void Retorna true se login for bem-sucedido, senão redireciona
     *
     * Fluxo:
     *  1. Busca usuário pelo email informado
     *  2. Se usuário não existir, chama isNotLoggedIn()
     *  3. Se a senha estiver correta, chama loggedIn()
     *  4. Caso contrário, chama isNotLoggedIn()
     */
    public function login(Model $model)
    {
        $this->model = $model;

        // Procura usuário no banco pelo email informado
        $this->user = $this->model->find('email', request('email'));

        if(!$this->user){
            return $this->isNotLoggedIn();
        }

        // Verifica se a senha fornecida corresponde à senha armazenada
        if(Password::verify(request('password'), $this->user->password)){
            return $this->loggedIn();
        }

        // Caso a senha esteja incorreta
        return $this->isNotLoggedIn();
    }

    /**
     * Método chamado quando login é bem-sucedido
     *
     * @return bool Cria a sessão do usuário via Sessions::startUsersSession
     */
    private function loggedIn()
    {
        return Sessions::startUsersSession($this->user, $this->model);
    }

    /**
     * Método chamado quando login falha
     *
     * - Adiciona flash message informando erro
     * - Redireciona para a página anterior
     *
     * @return void
     */
    private function isNotLoggedIn()
    {
        // Define mensagem de erro
        flash(['login' =>'Usuário ou senhas inválidos']);

        // Retorna para a página anterior
        return back();
    }
}

/*
================================================================================
RESUMO:

1. login(Model $model)
   - Tenta autenticar o usuário pelo email e senha
   - Chama loggedIn() se sucesso
   - Chama isNotLoggedIn() se falha

2. loggedIn()
   - Cria a sessão do usuário logado via Sessions

3. isNotLoggedIn()
   - Define flash message de erro
   - Redireciona para página anterior

⚠️ Dicas:
- Sempre use Login::login passando o Model correto.
- As mensagens de flash ajudam a informar o usuário sobre falhas.
================================================================================
*/
