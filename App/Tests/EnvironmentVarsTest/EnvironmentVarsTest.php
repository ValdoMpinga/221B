<?php

require_once __DIR__ . '/../../vendor/autoload.php'; //vendor location
define('BASE_PATH', realpath(__DIR__ . '/../../')); //.env folder's location

use PhpParser\Node\Stmt\Echo_;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class EnvironmentVarsTest extends TestCase
{
    /** @test */
    public function checkDataBaseCredentials(): void
    {

        $dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);;
        $dotenv->load();

        $dataBaseName = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $host = $_ENV['DB_HOST'];

        echo $dataBaseName;
        echo $username;
        echo $password;
        echo $host;

        assertEquals('221b_test', $dataBaseName, 'Nome da base de dados errada!!!');
        assertEquals($username, '221B_DB', 'username invalido!!!');
        assertEquals($password, 'sherlockAwesomeHolmes', 'palavra-passe invalida!!!');
        assertEquals($host, 'localhost', 'Host errado!!!');
    }
}
?>