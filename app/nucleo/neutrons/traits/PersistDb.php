<?php

namespace app\nucleo\neutrons\traits;

use app\nucleo\neutrons\models\querybuilder\create\Insert;
use app\nucleo\neutrons\models\querybuilder\update\Update;

/**
 * Trait PersistDb
 * ----------------
 * Fornece métodos genéricos de persistência no banco de dados:
 *  - insert(): insere registros
 *  - update(): atualiza registros
 * 
 * Observações:
 *  - Assume que a classe que usa esta trait possui:
 *      - $table     : string, nome da tabela
 *      - $connection: PDO, instância de conexão bindada
 *  - Utiliza classes auxiliares de query builder para gerar SQL
 */
trait PersistDb
{
    /**
     * Insere um registro na tabela
     *
     * @param array|object $attributes Dados do registro a inserir
     * @return string|false ID do último registro inserido ou false em caso de falha
     */
    public function insert($attributes)
    {
        // Garante que $attributes seja um array
        $attributes = (array) $attributes;

        // Gera SQL de insert usando a classe Insert
        $sql = Insert::sql($this->table, $attributes);

        // Prepara a query
        $insert = $this->connection->prepare($sql);

        // Executa a query
        if ($insert->execute($attributes)) {
            // Retorna o ID do último registro inserido
            return $this->connection->lastInsertId();
        }

        // Retorna false em caso de falha
        return false;
    }

    /**
     * Atualiza registros na tabela
     *
     * @param array|object $attributes Campos a serem atualizados
     * @param array|string $where Condições para o update (ex: ['id' => 5])
     * @return int Número de linhas afetadas
     */
    public function update($attributes, $where)
    {
        // Garante que $attributes seja um array
        $attributes = (array) $attributes;

        // Cria SQL de update usando a classe Update e adiciona cláusula WHERE
        $sql = (new Update)->where($where)->sql($this->table, $attributes);

        // Prepara a query
        $update = $this->connection->prepare($sql);

        // Executa a query
        $update->execute($attributes);

        // Retorna o número de linhas afetadas
        return $update->rowCount(); 
    }
}
