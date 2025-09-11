<?php

namespace app\nucleo\neutrons\models;

use app\nucleo\protons\gears\Bind;
use app\nucleo\neutrons\traits\Paginate;
use app\nucleo\neutrons\traits\PersistDb;

/**
 * ===========================================================
 *                        MODEL BASE
 * ===========================================================
 * Classe abstrata Model
 * ---------------------
 * Serve como base para todos os Models do framework.
 * Fornece métodos genéricos para CRUD e consulta ao banco.
 * 
 * Traits utilizadas:
 *  - PersistDb: fornece métodos de persistência (save, update)
 *  - Paginate: fornece métodos para paginação de resultados
 * 
 * Propriedades:
 *  - $connection : PDO, instância da conexão com o banco
 *  - $table      : string, nome da tabela associada ao model
 *  - $fields     : string, campos a serem selecionados (padrão '*')
 * 
 * Observações:
 *  - Todos os Models que extendem desta classe herdam estas funcionalidades.
 *  - Conexão PDO é obtida via Bind::get('connection') do container.
 */
abstract class Model
{
    use PersistDb;
    use Paginate;

    // Instância da conexão PDO
    protected $connection;

    // Nome da tabela no banco
    protected $table;

    // Campos a serem selecionados nas queries (default '*')
    protected $fields = '*';

    /**
     * Construtor: obtém a conexão PDO do container
     */
    public function __construct() {
        $this->connection = Bind::get('connection');
    }

    /**
     * Retorna todos os registros da tabela
     *
     * @return array Lista de objetos com todos os registros
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $list = $this->connection->prepare($sql);
        $list->execute();
        return $list->fetchAll();
    }

    /**
     * Busca um registro por um campo específico
     *
     * @param string $field Nome do campo
     * @param mixed $value Valor do campo
     * @return object|null Registro encontrado ou null
     */
    public function find($field, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :{$field}";
        $list = $this->connection->prepare($sql);
        $list->bindValue($field, $value);
        $list->execute();
        return $list->fetch();
    }

    /**
     * Busca múltiplos registros por um campo específico
     *
     * @param string $field Nome do campo
     * @param mixed $value Valor do campo
     * @return array Lista de registros encontrados
     */
    public function findBy($field, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :value";
        $list = $this->connection->prepare($sql);
        $list->bindValue(':value', $value);
        $list->execute();
        return $list->fetchAll();
    }

    /**
     * Deleta registros por um campo específico
     *
     * @param string $field Nome do campo
     * @param mixed $value Valor do campo
     * @return int Número de linhas deletadas
     */
    public function delete($field, $value)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$field} = ?";
        $delete = $this->connection->prepare($sql);
        $delete->bindValue(1, $value);
        $delete->execute();
        return $delete->rowCount();
    }

    // Outros métodos de consulta podem ser adicionados aqui
}
