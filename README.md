# PHP coding test application

## Description
This application allows the user to write data to a database and display that data.  It can be accessed by commandline via *application.php*.
It can also be accessed in the browser in the *public/* directory.

## Usage
To use the commandline application: 
- Enter the root folder and type in `php application.php` to view the available commands
- To populate the database use the `database:populate-database` command with the number of records as the sole argument
- To view the records use the `database:display-data` command with no arguments

## Configuration
Connection parameters are set in */src/Database/DatabaseConnection.php*:

```php
$this->params = array(
    'dbname' => 'task_1_php',
    'user' => 'root',
    'password' => null,
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
);
```
