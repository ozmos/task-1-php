<?php

namespace Models;

use Database\DatabaseConnection;

class Data extends DatabaseConnection 
{
    private $table;

    public function __construct(string $table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function retrieveRecords()
    {
        
    }


}
