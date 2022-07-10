<?php

require_once  'C:\xampp\htdocs\221b\App\Tests\DatabaseSingleton.class.php';

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class EnvironmentTest extends TestCase
{

    private string $environment_name;
    private string $environment_description;
    private string $environment_state;
    private string $user_id;
    private string $environment_creation_date;
    private string $environment_picture;
    private string $last_accessed_environment;


    /** @test */
    public function createEnvironment(): void
    {
        $this->user_id=5;
        $this->environment_name='Escritorio principal';
        $this->environment_description='Escritorio dos assuntos mais importantes';
        $this->environment_state=1;

        $connectionInstance=DatabaseSingleton::getInstance();
        $connection=$connectionInstance->getConnection();

        $selectDataBase='use 221b_test';
        $insertQuery="select createEnvironment('$this->user_id','$this->environment_name','$this->environment_description','$this->environment_state','sysdate()')";

        $connection->query($selectDataBase);
        $result=$connection->query($insertQuery);
        
        assert(true,$result);

    }


    public function deleteEnvironment(): void
    {
        $connectionInstance=DatabaseSingleton::getInstance();
        $connectionOne=$connectionInstance->getConnection();
    }
}
