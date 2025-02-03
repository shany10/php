<?php

namespace App\Core;

use PDO;
use PDOStatement;
use App\Core\DatabaseConnection;

class QueryBuilder
{
  private string $sql;
  private array $parameters;
  private $db;

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
    // Utiliser un paramètre nommé pour éviter l'injection SQL
    $paramName = ":where_" . $columnName;
    $this->sql .= " WHERE " . $columnName . " = " . $paramName;

    // Ajouter la valeur à la liste des paramètres
    $this->parameters[$paramName] = $columnValue;

    return $this;
  }

  public function createTable(string $tableName, array $columns, array $options = []): self
  {
    $columnDefinitions = [];
    foreach ($columns as $name => $definition) {
      $columnDefinitions[] = "$name $definition";
    }

    $optionsSQL = implode(" ", $options);

    $this->sql = "CREATE TABLE $tableName (" . implode(", ", $columnDefinitions) . ") $optionsSQL";

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
  public function fetch()
  {
    $this->query()->execute($this->parameters);
    return $this->query()->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchAll(): array
  {
    $this->query()->execute($this->parameters);
    return $this->query()->fetchAll(PDO::FETCH_ASSOC);
  }

  public function executeAndGetId(): int
  {
    try {
      $this->query()->execute($this->parameters);
      return (int)$this->db->lastInsertId();
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
    return new PDO("
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


// Exemple d'utilisation
// $queryBuilder = new QueryBuilder();

// $email = "anairi@esgi.fr";

// $result = $queryBuilder
//   ->select(["id", "password", "email"])
//   ->from("users")
//   ->where("email", $email)
//   ->fetch();

// print_r($result);
