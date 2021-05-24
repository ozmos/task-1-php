<?php

namespace Database;

use Database\DatabaseConnection;

class Migration extends DatabaseConnection
{
    private $schema;

    public function __construct()
    {
        parent::__construct();
        $this->schema = new \Doctrine\DBAL\Schema\Schema();
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
    }

    public function exists()
    {
        $databases = $this->schemaManager->listTables();
        return count($databases) > 0;
    }
}
