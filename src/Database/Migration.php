<?php

namespace Database;

use Database\DatabaseConnection;
use Doctrine\DBAL\Schema\Schema;

class Migration extends DatabaseConnection
{
    private $schema;

    public function __construct()
    {
        parent::__construct();
        $this->schema = new Schema();
    }

    /**
     * Creates 'user' table fields and migrates them to the database
     *
     * @return void
     */
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

    /**
     * Checks if database already contains tables
     *
     * @return boolean
     */
    public function exists(): bool
    {
        $databases = $this->schemaManager->listTables();
        return count($databases) > 0;
    }
}
