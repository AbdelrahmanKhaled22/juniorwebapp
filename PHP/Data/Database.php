<?php

namespace ProductData;

class Database
{
    private $host = 'localhost';
    private $db = 'productdb';
    private $user = 'root';
    private $pass = 'OAK_ROOT6497';
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, // By default ERRMODE only makes warnings so I'm setting it to throw exceptions
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,       // Making the default fetching mode FETCH_ASSOC makes it so rows are fetched as associative arrays
            \PDO::ATTR_EMULATE_PREPARES   => false,                   // We'll be creating our own prepared statement so this is not necessary
        ];

        try {
            $this->pdo = new \PDO($dsn, $this->user, $this->pass, $options); // Passing in our configuration for the db
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
