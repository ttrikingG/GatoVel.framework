<?php

namespace app\eletrons\validate\site;

use app\nucleo\neutrons\storage\site\User;
use app\eletrons\validate\Validate;

class Register extends Validate
{
    public function validate()
    {
        // Campos obrigatórios
        $this->required(['firstName', 'lastName', 'email', 'password']);

        // Valida email
        $this->email(['email']);

        // Senha: mínimo 6 caracteres
        $this->min(['password' => 6]);

        // Senha: máximo 8 caracteres
        $this->max(['password' => 8]);

        // Senha: pelo menos uma letra e um símbolo
        $this->password(['password']);

        // Verifica se email já existe
        $this->unique(['email' => User::class]);
    }
}

