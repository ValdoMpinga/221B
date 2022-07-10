<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

require_once  'C:\xampp\htdocs\App\221B\Tests\DatabaseSingleton.class.php';

final class UserTest extends TestCase
{

    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $birth_date;
    private $user_stae;

    /** @test */
    //  public function register(): void
    //  {
    //      $connectionInstance=DatabaseSingleton::getInstance();
    //      $connection=$connectionInstance->getConnection();

    //      $this->first_name='Josuke';
    //      $this->last_name='Higashikata';
    //      $this->email='crazydiamond';
    //      $this->password=password_hash('movingfUpAndDownSideToSideLikeARollercoaster!!!',PASSWORD_BCRYPT);



    //     echo 'Hashed password: '.$this->password;

    //      $selectDataBase='use 221b_test';
    //      $insertQuery="call registerUser('$this->first_name','$this->last_name','$this->email','$this->password','sysdate()')";

    //      $executeQuery1=$connection->query($selectDataBase);
    //      $executeQuery2=$connection->query($insertQuery);

    //     $this->markTestIncomplete(
    //          'This test has not been implemented yet.'
    //        );
    //      assertEquals(true,$executeQuery2,'Os dados não foram inseridos');
    //  }


    /** @test */
    public function login(): void
    {
        $email='crazyDiamond';
        $password='movingfUpAndDownSideToSideLikeARollercoaster!!!';

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select password from user where email=:email");
        $result->bindParam(":email", $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        // if (password_verify($row['password'], PASSWORD_BCRYPT))
        //     echo 'it is';

         $isIt='Bool: ' .password_verify($password,$row['password']);
        echo $isIt;
        assertEquals(true,password_verify($password,$row['password']), 'Username ou palavra-passe errada!!!');
    }

    /** @test */
    // public function deleteEnvironment(): void
    // {
    //     $connectionInstance=DatabaseSingleton::getInstance();
    //     $connection=$connectionInstance->getConnection();

    //     $selectDataBase='use 221b_test';
    //     $deleteQuery="call deleteEnvironment(1,1)";

    //     $connection->query($selectDataBase);
    //     $connection->query($deleteQuery);
    // }

    // private function getFirstName()
    //    { return $this->first_name;} 
}
