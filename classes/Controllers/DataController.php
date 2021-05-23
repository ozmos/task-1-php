<?php

namespace Controllers;

use Database\DatabaseConnection;

class DataController extends DatabaseConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = $this->queryBuilder
        ->select('username', 'email', 'address')
        ->from('users');
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->executeQuery();
        $users = $result->fetchAllAssociativeIndexed();
        return $users;
    }
}
