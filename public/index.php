<?php

require_once '../vendor/autoload.php';
require_once '../classes/Database/DatabaseConnection.php';
require_once '../classes/Database/Migration.php';

use Database\Connection;
use Database\Migration;

$conn = new Connection();

$conn->conn->beginTransaction();

try {
    // create schemas
    $migration = new Migration();
    $migration->up();

    // populate tables
    

    

    // $sql = $conn->queryBuilder
    //     ->select('id', 'username', 'email')
    //     ->from('users');
    // $stmt = $conn->conn->prepare($sql);
    // $result = $stmt->executeQuery();
    // $articles = $result->fetchAllAssociativeIndexed();

    // var_dump($articles);
    echo "all good";
    $conn->conn->commit();
} catch (\Exception $e) {
    $conn->conn->rollBack();
    throw $e;
}
