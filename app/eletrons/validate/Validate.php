<?php

namespace app\eletrons\validate;

use Exception;

/**
 * Classe abstrata Validate
 * ------------------------
 * Responsável por validar dados de formulários enviados via $_POST.
 *  
 * Funcionalidades:
 *  - Campos obrigatórios
 *  - Validação de email
 *  - Comprimento mínimo e máximo
 *  - Valores únicos no banco
 *  - Regras específicas de senha
 *  - Armazenamento centralizado de mensagens de erro
 * 
 * Uso típico:
 *  $validator = new MyFormValidate();
 *  $validator->required(['email', 'password']);
 *  $validator->email(['email']);
 *  $validator->min(['password' => 6]);
 *  $validator->max(['username' => 20]);
 *  if ($validator->hasErrors()) {
 *      $errors = $validator->getErrors();
 *  }
 */
abstract class Validate
{
    /**
     * Armazena todos os erros de validação
     * Estrutura: ['campo' => ['mensagem1', 'mensagem2']]
     */
    private $errors = [];

    // --------------------------------------------------------
    // MÉTODOS PÚBLICOS DE VALIDAÇÃO
    // --------------------------------------------------------

    /**
     * Valida campos obrigatórios
     * ---------------------------
     * @param array $fields Campos que devem ser preenchidos
     * Se $fields estiver vazio, valida todos os campos do $_POST
     */
    public function required(array $fields)
    {
        $this->fieldsIsArray($fields);

        if (empty($fields)) {
            foreach ($_POST as $key => $value) {
                $this->isEmpty($key);
            }
            return;
        }

        foreach ($fields as $field) {
            $this->isEmpty($field);
        }
    }

    /**
     * Valida formato de email
     * ------------------------
     * @param array $fields Campos que devem conter emails válidos
     */
    public function email(array $fields)
    {
        $this->fieldsIsArray($fields);

        foreach ($fields as $field) {
            if (!filter_var($_POST[$field] ?? '', FILTER_VALIDATE_EMAIL)) {
                $this->errors[$field][] = 'Email inválido.';
            }
        }
    }

    /**
     * Valida comprimento mínimo dos campos
     * -------------------------------------
     * @param array $fields Associativo: ['campo' => minLength]
     */
    public function min(array $fields)
    {
        $this->fieldsIsArray($fields);

        foreach ($fields as $field => $length) {
            if (isset($_POST[$field]) && strlen($_POST[$field]) < $length) {
                $this->errors[$field][] = "O campo deve ter no mínimo {$length} caracteres.";
            }
        }
    }

    /**
     * Valida comprimento máximo dos campos
     * -------------------------------------
     * @param array $fields Associativo: ['campo' => maxLength]
     */
    public function max(array $fields)
    {
        $this->fieldsIsArray($fields);

        foreach ($fields as $field => $length) {
            if (isset($_POST[$field]) && strlen($_POST[$field]) > $length) {
                $this->errors[$field][] = "O campo deve ter no máximo {$length} caracteres.";
            }
        }
    }

    /**
     * Valida se o valor é único no banco
     * -----------------------------------
     * @param array $fields Associativo: ['campo' => Model]
     */
    public function unique(array $fields)
    {
        $this->fieldsIsArray($fields);

        foreach ($fields as $field => $model) {
            $modelInstance = new $model;

            if (isset($_POST[$field]) && $modelInstance->find($field, $_POST[$field])) {
                $this->errors[$field][] = 'Este valor já foi cadastrado.';
            }
        }
    }

    /**
     * Valida campos de senha
     * ----------------------
     * Regras:
     *  - Deve conter pelo menos uma letra
     *  - Deve conter pelo menos um símbolo
     * @param array $fields Campos que representam senhas
     */
    public function password(array $fields)
    {
        $this->fieldsIsArray($fields);

        foreach ($fields as $field) {
            $password = $_POST[$field] ?? '';

            if (!preg_match('/[a-zA-Z]/', $password)) {
                $this->errors[$field][] = "A senha deve conter pelo menos uma letra.";
            }

            if (!preg_match('/[\W_]/', $password)) {
                $this->errors[$field][] = "A senha deve conter pelo menos um símbolo.";
            }
        }
    }

    /**
     * Verifica se existem erros de validação
     * --------------------------------------
     * @return bool True se houver erros, false caso contrário
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Retorna todos os erros de validação
     * -----------------------------------
     * @return array Estrutura: ['campo' => ['mensagem1', 'mensagem2']]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    // --------------------------------------------------------
    // MÉTODOS PRIVADOS AUXILIARES
    // --------------------------------------------------------

    /**
     * Verifica se um campo está vazio
     * -------------------------------
     * @param string $field Nome do campo
     */
    private function isEmpty(string $field)
    {
        if (empty($_POST[$field])) {
            $this->errors[$field][] = 'Este campo é obrigatório.';
        }
    }

    /**
     * Garante que os campos passados sejam arrays
     * -------------------------------------------
     * @param mixed $fields Qualquer valor
     * @throws Exception Caso não seja array
     */
    private function fieldsIsArray($fields)
    {
        if (!is_array($fields)) {
            throw new Exception('O parâmetro de validação precisa ser um array.');
        }
    }
}
