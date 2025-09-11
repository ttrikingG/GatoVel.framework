<?php

namespace app\nucleo\neutrons\storage\site;

use app\nucleo\neutrons\models\Model;

/**
 * ===========================================================
 *                     MODEL Exemplo: User
 * ===========================================================
 * Representa a tabela 'users' no banco de dados.
 *
 * Herda de:
 *   - Model
 *       -> Oferece métodos genéricos de CRUD: find, all, create, update, delete
 *
 * Propriedades específicas:
 *   - $table: nome da tabela no banco ('users')
 *   - $session: chave usada para armazenar login do usuário na sessão
 *   - $user_id: chave para armazenar o ID do usuário na sessão
 *   - $user_name: chave para armazenar o nome completo do usuário na sessão
 *
 * Uso:
 *   - Esta classe é utilizada pelo sistema de login para validar usuários.
 *   - Pode ser expandida para adicionar métodos específicos, por exemplo:
 *       - getFullName()
 *       - isAdmin()
 *       - etc.
 */
class User extends Model
{
    // Nome da tabela no banco de dados
    protected $table = 'users';

    // Chaves de sessão para login do usuário
    //public $session   = 'user_logged';  // Booleano indicando se está logado
    //public $user_id   = 'user_id';      // Armazena o ID do usuário na sessão
    //public $user_name = 'user_name';    // Armazena o nome completo do usuário na sessão
}
