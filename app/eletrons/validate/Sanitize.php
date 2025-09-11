<?php

namespace app\eletrons\validate;

use app\protons\gears\login\Password;

/**
 * Classe Sanitize
 * ----------------
 * Responsável por:
 *  - Limpar dados recebidos via $_POST
 *  - Remover tags HTML e proteger contra XSS básico
 * 
 * Uso típico:
 *  $sanitizer = new Sanitize();
 *  $data = $sanitizer->sanitized();
 *  // $data agora é um objeto com os campos do POST limpos
 */
class Sanitize
{
    // Armazena os valores sanitizados
    protected $sanitized = [];

    /**
     * Retorna os dados sanitizados do POST
     *
     * @return object Objeto com os campos do POST já limpos de tags HTML
     */
    public function sanitized()
    {
        $posts = $_POST; // Captura todos os dados enviados via POST

        foreach ($posts as $name => $value) {
            // Remove tags HTML de cada campo
            $this->sanitized[$name] = strip_tags($value);
        }

        // Converte o array sanitizado em objeto para facilitar o acesso
        return (object) $this->sanitized;
    }
}
