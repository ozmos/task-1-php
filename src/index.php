<?php

require_once '../vendor/autoload.php';
require_once 'Database/DatabaseConnection.php';
require_once 'Database/Migration.php';
require_once 'Database/DataFactory.php';
require_once 'Models/Data.php';

use Database\DatabaseConnection;
use Database\Migration;
use Database\DataFactory;
use Models\data;

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
    $data = new data();
    var_dump($data->users());

    $connection->conn->commit();
} catch (\Exception $e) {
    $connection->conn->rollBack();
    throw $e;
}
