<?php

require_once "DatabaseConnection.php";

class QueryBuilder
{
    private string $sql;
    private array $parameters;
    private $db;
    private bool $ifNotExists = false;

    public function __construct()
    {
        $this->reset();
        $this->db = DatabaseConnection::getInstance();
    }

    public function select(array $columns): self
    {
        $this->sql = "SELECT " . implode(", ", $columns);
        return $this;
    }



    public function from(string $tableName): self
    {
        $this->sql .= " FROM " . $tableName;
        return $this;
    }

    public function where(string $columnName, $columnValue): self
    {
        $paramName = ":where_" . $columnName;
        $this->sql .= (strpos($this->sql, "WHERE") === false ? " WHERE " : " AND ") . "$columnName = $paramName";
        $this->parameters[$paramName] = $columnValue;

        return $this;
    }

    public function ifNotExists(bool $condition = true): self
    {
        $this->ifNotExists = $condition;
        return $this;
    }

    public function createTable(string $tableName, array $columns, array $options = []): self
    {
        $columnDefinitions = [];
        foreach ($columns as $name => $definition) {
            $columnDefinitions[] = "$name $definition";
        }

        $ifNotExistsSQL = $this->ifNotExists ? "IF NOT EXISTS" : "";


        $optionsSQL = implode(" ", $options);

        $this->sql = "CREATE TABLE $ifNotExistsSQL $tableName (" . implode(", ", $columnDefinitions) . ") $optionsSQL";

        return $this;
    }

    public function delete(string $tableName): self
    {
        $this->sql = "DELETE FROM " . $tableName;
        return $this;
    }

    public function insert(string $tableName, array $data): self
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($column) => ":" . $column, $columns);

        $this->sql = "INSERT INTO " . $tableName . " (" . implode(", ", $columns) . ")";
        $this->sql .= " VALUES (" . implode(", ", $placeholders) . ")";

        foreach ($data as $column => $value) {
            $this->parameters[":" . $column] = $value;
        }

        return $this;
    }

    public function update(string $tableName, array $data): self
    {
        $this->sql = "UPDATE " . $tableName . " SET ";
        $updates = [];

        foreach ($data as $column => $value) {
            $paramName = ":set_" . $column;
            $updates[] = $column . " = " . $paramName;
            $this->parameters[$paramName] = $value;
        }

        $this->sql .= implode(", ", $updates);
        return $this;
    }

    public function addForeignKey(string $tableName, string $columnName, string $foreignTableName, string $foreignColumnName): self
    {
        $this->sql = "ALTER TABLE " . $tableName . " ADD FOREIGN KEY (" . $columnName . ") REFERENCES " . $foreignTableName . "(" . $foreignColumnName . ")";
        return $this;
    }


    public function join(string $table, string $onClause, string $type = "INNER"): self
    {
        $this->sql .= " $type JOIN " . $table . " ON " . $onClause;
        return $this;
    }

    public function orderBy(string $column, string $direction = "ASC"): self
    {
        $this->sql .= " ORDER BY " . $column . " " . strtoupper($direction);
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->sql .= " LIMIT " . $limit;
        return $this;
    }

    public function fetch()
    {
        $stmt = $this->query();
        $stmt->execute($this->parameters);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function fetchAll(): array
    {
        $stmt = $this->query();
        $stmt->execute($this->parameters);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function executeAndGetId(): int
    {
        try {

            $this->query()->execute($this->parameters);
            return (int) $this->db->lastInsertId();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function execute()
    {
        return $this->query()->execute($this->parameters);
    }

    private function query(): PDOStatement
    {
        $stmt = $this->db->prepare($this->sql);
        return $stmt;
    }

    private function getConnection(): PDO
    {
        return new PDO(
            "
      mysql:host=mariadb;dbname="
                . $_ENV["DATABASE_NAME"],
            $_ENV["DATABASE_USER"],
            $_ENV["DATABASE_PASSWORD"]
        );
    }

    public function reset(): self
    {
        $this->sql = "";
        $this->parameters = [];
        return $this;
    }
}
