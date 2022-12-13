<?php
// connect to MySQL database.
class Database {
    public $connection;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=myapp;charset=utf8mb4";
        $username = 'appUser';
        $password = 'password';
        $this->connection  = new PDO($dsn, $username, $password);
    }
    public function query($query) {
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }
}