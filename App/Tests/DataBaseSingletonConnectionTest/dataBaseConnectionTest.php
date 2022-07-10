<?php

require_once  'C:\xampp\htdocs\221b\Backend\Tests\DatabaseSingleton.class.php';

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class dataBaseConnectionTest extends TestCase
{
    /** @test */
    public function testConnection(): void
    {
        $connectionInstance=DatabaseSingleton::getInstance();
        $connectionOne=$connectionInstance->getConnection();
        $connectionTwo=$connectionInstance->getConnection();
        assertEquals($connectionOne, $connectionTwo, 'As 
        instancias sao diferentes!!!');
    }
}
