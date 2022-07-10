<?php

use function PHPUnit\Framework\isEmpty;

require_once  'C:\xampp\htdocs\App\221B\app\models\DatabaseConnection\DatabaseSingleton.class.php';

class Login
{
    public function Login($email, $password)
    {
        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select password,user_state from user where email=:email");
        $result->bindParam(":email", $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        if ($row) {
            if (password_verify($password, $row['password']) && $row['user_state']==true)
                return true;
            else
                return false;
        } else
            return false;
    }

    public function getUsersCreds($email)
    {
        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select * from user where email=:email");
        $result->bindParam(":email", $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        return $row;
    }

    public function deactivateUserAccount($email)
    {
        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("call deleteUser(:email)");
        $result->bindParam(":email", $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        return $row;
    }

    
}
// mobilemolwene