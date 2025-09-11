<?php

namespace app\eletrons\validate;

/**
 * Classe Validation
 * -----------------
 * Responsável por sanitizar dados enviados via $_POST.
 * Remove tags HTML e retorna um objeto com os valores limpos.
 *
 * Uso típico:
 *  $validator = new Validation();
 *  $cleanData = $validator->validate($_POST);
 *  echo $cleanData->email; // valor sanitizado
 */
class Validation
{
    /**
     * Armazena os dados sanitizados
     *
     * @var array
     */
    private $validate = [];

    /**
     * Sanitiza os dados enviados
     *
     * @param array $post Array de dados a ser sanitizado (ex: $_POST)
     * @return object Objeto com os valores limpos
     */
    public function validate(array $post)
    {
        foreach ($post as $key => $value) {
            // Remove todas as tags HTML e PHP
            $this->validate[$key] = strip_tags($value);
        }

        // Retorna como objeto para fácil acesso via $obj->campo
        return (object) $this->validate;
    }
}
