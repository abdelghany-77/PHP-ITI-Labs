<?php

class Database
{
  private $host;
  private $username;
  private $password;
  private $database;
  private $connection;

  public function connect($host, $username, $password, $database)
  {
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;

    $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

    if ($this->connection->connect_error) {
      die("Connection failed: " . $this->connection->connect_error);
      return false;
    }

    echo "Connected successfully to database!<br>";
    return true;
  }

  public function insert($tableName, $columns)
  {
    $columnNames = array_keys($columns);
    $columnValues = array_values($columns);

    $columnsString = implode(', ', $columnNames);

    $valuesString = "'" . implode("', '", $columnValues) . "'";

    $sql = "INSERT INTO $tableName ($columnsString) VALUES ($valuesString)";

    if ($this->connection->query($sql) === TRUE) {
      echo "New record inserted successfully!<br>";
      return true;
    } else {
      echo "Error: " . $sql . "<br>" . $this->connection->error . "<br>";
      return false;
    }
  }

  public function select($tableName)
  {
    $sql = "SELECT * FROM $tableName";

    $result = $this->connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    } else {
      echo "No records found in $tableName<br>";
    }

    return $data;
  }
  public function update($tableName, $id, $fields)
  {
    $setString = "";
    foreach ($fields as $column => $value) {
      $setString .= "$column = '$value', ";
    }
    $setString = rtrim($setString, ', ');

    $sql = "UPDATE $tableName SET $setString WHERE id = $id";

    if ($this->connection->query($sql) === TRUE) {
      echo "Record updated successfully!<br>";
      return true;
    } else {
      echo "Error updating record: " . $this->connection->error . "<br>";
      return false;
    }
  }

  public function delete($tableName, $id)
  {
    $sql = "DELETE FROM $tableName WHERE id = $id";

    if ($this->connection->query($sql) === TRUE) {
      echo "Record deleted successfully!<br>";
      return true;
    } else {
      echo "Error deleting record: " . $this->connection->error . "<br>";
      return false;
    }
  }


  public function closeConnection()
  {
    if ($this->connection) {
      $this->connection->close();
      echo "Connection closed!<br>";
    }
  }
}
