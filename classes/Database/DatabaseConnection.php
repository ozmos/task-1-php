<?php

namespace Database;

use Doctrine\DBAL\DriverManager;

class DatabaseConnection
{
    private $params;
    public $conn;
    public $queryBuilder;

    public function __construct()
    {
        $this->params = array(
            'dbname' => 'task_1_php',
            'user' => 'root',
            'password' => null,
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql',
        );

        $this->conn = DriverManager::getConnection($this->params);

        $this->queryBuilder = $this->conn->createQueryBuilder();
    }
}
