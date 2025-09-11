<?php

namespace app\nucleo\protons\gears\login;

/**
 * ===========================================================
 *                     CLASSE: Password
 * ===========================================================
 * Responsável por gerenciar hashing e verificação de senhas.
 *
 * Funcionalidades principais:
 *  - hash($password)   -> Gera um hash seguro da senha
 *  - verify($password, $hash) -> Verifica se a senha corresponde ao hash
 *
 * Obs:
 *  - Usa funções nativas do PHP: password_hash e password_verify
 *  - Configuração de custo (cost) para aumentar segurança do hash
 */
class Password
{
    /**
     * Gera um hash seguro para uma senha
     *
     * @param string $password Senha em texto puro
     * @return string Hash gerado
     *
     * Exemplo:
     *   $hash = Password::hash('minhaSenha123');
     */
    public static function hash($password)
    {
        $options = [
            'cost' => 12, // Define o custo do hash (quanto maior, mais seguro e mais lento)
        ];

        return password_hash($password, PASSWORD_DEFAULT, $options);
    }

    /**
     * Verifica se a senha informada corresponde ao hash
     *
     * @param string $password Senha em texto puro
     * @param string $hash Hash previamente gerado
     * @return bool True se a senha corresponder, False caso contrário
     *
     * Exemplo:
     *   if(Password::verify('senha', $hash)) { ... }
     */
    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}

/*
================================================================================
RESUMO:

1. Password::hash($password)
   - Cria um hash seguro da senha usando PASSWORD_DEFAULT
   - Usa cost=12 para aumentar segurança

2. Password::verify($password, $hash)
   - Compara a senha em texto puro com o hash
   - Retorna true se corresponder, false se não

⚠️ Dicas:
- Sempre armazene apenas o hash no banco de dados.
- Nunca armazene senhas em texto puro.
================================================================================
*/
