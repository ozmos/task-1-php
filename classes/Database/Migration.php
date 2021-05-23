<?php

namespace Database;

use Database\Connection;

class Migration
{
    private $schema;
    private $connection;
    private $queries;
    private $schemaManager;

    public function __construct()
    {
        $this->schema = new \Doctrine\DBAL\Schema\Schema();
        $this->connection = new Connection();
        $this->schemaManager = $this->connection->conn->getSchemaManager();
    }

    public function up()
    {
        if ($this->exists()) {
            return;
        }

        $users = $this->schema->createTable('users');
        $users->addColumn("id", "integer", array("unsigned" => true));
        $users->addColumn("username", "string", array("length" => 32));
        $users->addColumn("email", "string", array("length" => 32));
        $users->setPrimaryKey(array("id"));
        $users->addUniqueIndex(array("username"));

        $queries = $this->schema->toSql($this->connection->conn->getDatabasePlatform());

        $this->connection->conn->executeStatement($queries[0]);
    }

    public function exists()
    {
        $databases = $this->schemaManager->listTables();
        return count($databases) > 0;
    }

}
