<?php

require_once __DIR__ . '/../../../vendor/autoload.php'; //vendor location
define('BASE_PATH', realpath(__DIR__ . '/../../../')); //.env folder's location

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);;
$dotenv->load();

class DatabaseSingleton
{
    private static $connectionInstance = null;
    private $connection;

    private $host;
    private $dataBaseName;
    private $username;
    private $password;



    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->host= $_ENV['DB_HOST'];
        $this->dataBaseName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];

        try
        {
            $this->connection = new PDO
            (
                "mysql:host={$this->host};
                dbname={$this->dataBaseName}",
                $this->username,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
        }
        catch(PDOException $e)
        {
            echo 'Ocorreu um erro! \n';
            echo $e;
            exit();
        }
    }

    public static function getInstance()
    {
        if (!self::$connectionInstance)
        {
            self::$connectionInstance = new DatabaseSingleton();
        }

        return self::$connectionInstance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
