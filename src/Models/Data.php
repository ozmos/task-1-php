<?php

namespace Models;

use Database\DatabaseConnection;

class Data extends DatabaseConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retrieves list of users in database
     *
     * @return array
     */
    public function users(): array
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
