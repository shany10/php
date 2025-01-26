<?php

class QueryBuilder
{
  private string $sql;
  private array $parameters;

  public function __construct()
  {
    $this->sql = "";
    $this->parameters = [];
  }

  public function select(array $columns)
  {
    $this->sql = "SELECT " . implode(", ", $columns);

    return $this;
  }

  public function from(string $tableName)
  {
    $this->sql .= " FROM " . $tableName;

    return $this;
  }

  public function where(string $columnName, $columnValue)
  {
    // Utiliser un paramètre nommé pour éviter l'injection SQL
    $paramName = ":where_" . $columnName;
    $this->sql .= " WHERE " . $columnName . " = " . $paramName;

    // Ajouter la valeur à la liste des paramètres
    $this->parameters[$paramName] = $columnValue;

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
    $databaseConnection = new PDO(
      "mysql:host=mariadb;dbname=database",
      "user",
      "password"
    );

    $statement = $databaseConnection->prepare($this->sql);

    $statement->execute($this->parameters);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchAll()
  {
    $databaseConnection = new PDO(
      "mysql:host=mariadb;dbname=database",
      "user",
      "password"
    );

    $statement = $databaseConnection->prepare($this->sql);

    $statement->execute($this->parameters);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function execute()
  {
    $databaseConnection = new PDO(
      "mysql:host=mariadb;dbname=database",
      "user",
      "password"
    );

    $statement = $databaseConnection->prepare($this->sql);

    return $statement->execute($this->parameters);
  }

  private function getConnection(): PDO
  {
      return new PDO("mysql:host=mariadb;dbname=database", "user", "password");
  }
}


// Exemple d'utilisation
$queryBuilder = new QueryBuilder();

$email = "anairi@esgi.fr";

$result = $queryBuilder
  ->select(["id", "password", "email"])
  ->from("users")
  ->where("email", $email)
  ->fetch();

print_r($result);