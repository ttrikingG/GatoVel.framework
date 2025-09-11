<?php

namespace app\nucleo\neutrons\models\querybuilder\read;

class Select
{
    private ?string $keyword = null;
    private array $targets = [];

    public function where(string $keyword): self
    {
        $this->keyword = $keyword;
        return $this;
    }

    public function from(array $targets): self
    {
        $this->targets = $targets;
        return $this;
    }

    public function sql(): string
    {
        if (!$this->keyword) {
            throw new \Exception("Defina a palavra-chave com o método where().");
        }

        if (empty($this->targets)) {
            throw new \Exception("Defina as tabelas e colunas com o método from().");
        }

        $queries = [];

        foreach ($this->targets as $table => $columns) {
            $select = $this->formatSelect($columns);
            $where = $this->formatWhere($columns);
            $queries[] = "SELECT {$select}, '{$table}' AS tipo FROM {$table} WHERE {$where}";
        }

        return implode("\nUNION ALL\n", $queries);
    }

    private function formatSelect(array $columns): string
    {
        $title = $columns['title'] ?? "''";
        $description = $columns['description'] ?? "''";

        return "id, {$title} AS title, {$description} AS description";
    }


    private function formatWhere(array $columns): string
    {
        $keyword = addslashes($this->keyword);

        return implode(' OR ', array_map(function ($col) use ($keyword) {
            return "{$col} LIKE '%{$keyword}%'";
        }, $columns));
    }
}

