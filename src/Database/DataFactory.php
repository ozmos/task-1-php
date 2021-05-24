<?php

namespace Database;

use Faker\Factory;
use Database\DatabaseConnection;

class DataFactory extends DatabaseConnection
{
    private $faker;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    /**
     * populates tables with dummy data
     *
     * @param integer $num
     * @return void
     */
    public function populate(int $num = 1)
    {
        foreach (range(0, $num - 1) as $value) {
            $this->conn->insert('users', array(
                'username' => $this->faker->name(),
                'email' => $this->faker->email(),
                'address' => $this->faker->address()
            ));
        }
    }
}
