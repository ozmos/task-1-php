<?php

require_once '../vendor/autoload.php';
require_once 'Database/DatabaseConnection.php';
require_once 'Database/Migration.php';
require_once 'Database/DataFactory.php';
require_once 'Controllers/DataController.php';

use Database\DatabaseConnection;
use Database\Migration;
use Database\DataFactory;
use Controllers\DataController;

$connection = new DatabaseConnection();

$connection->conn->beginTransaction();

try {
    // create schemas
    $migration = new Migration();
    $migration->up();

    // populate tables
    $factory = new DataFactory();
    $factory->populate(7);


    // display data
    $userController = new DataController();
    var_dump($userController->index());
    
    $connection->conn->commit();
} catch (\Exception $e) {
    $connection->conn->rollBack();
    throw $e;
}
