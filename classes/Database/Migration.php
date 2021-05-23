<?php

namespace Database;

use Database\DatabaseConnection;

class Migration extends DatabaseConnection
{
    private $schema;
    // private $connection;
    private $schemaManager;

    public function __construct()
    {
        parent::__construct();
        $this->schema = new \Doctrine\DBAL\Schema\Schema();
        // $this->connection = new DatabaseConnection();
        $this->schemaManager = $this->conn->getSchemaManager();
        // $this->schemaManager = $this->connection->conn->getSchemaManager();
    }

    public function up()
    {
        if ($this->exists()) {
            return;
        }

        $users = $this->schema->createTable('users');
        $users->addColumn(
            "id", 
            "integer", 
            array(
                "unsigned" => true, 
                "autoincrement" => true
                )
            );
        $users->addColumn("username", "string", array("length" => 32));
        $users->addColumn("email", "string", array("length" => 128));
        $users->addColumn("address", "string", array("length" => 128));
        $users->setPrimaryKey(array("id"));
        $users->addUniqueIndex(array("username"));
        $users->addUniqueIndex(array("email"));

        $queries = $this->schema->toSql($this->conn->getDatabasePlatform());

        $this->conn->executeStatement($queries[0]);
        $queries = $this->schema->toSql($this->conn->getDatabasePlatform());

        // $this->connection->conn->executeStatement($queries[0]);
    }

    public function exists()
    {
        $databases = $this->schemaManager->listTables();
        return count($databases) > 0;
    }
}
