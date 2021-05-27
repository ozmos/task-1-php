<?php

require_once '../vendor/autoload.php';

use Database\DatabaseConnection;
use Doctrine\DBAL\Schema\Schema;
use Database\Migration;
use Database\DataFactory;
use Models\Data;

$connection = new DatabaseConnection();

$connection->conn->beginTransaction();

try {
    // create schemas
    $migration = new Migration(new Schema());
    $migration->up();

    // populate tables
    $factory = new DataFactory();
    $factory->populate(7);


    // display data
    $data = new Data();
    var_dump($data->users());

    $connection->conn->commit();
} catch (\Exception $e) {
    $connection->conn->rollBack();
    throw $e;
}
