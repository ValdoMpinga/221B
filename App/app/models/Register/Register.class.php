<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\DatabaseConnection\DatabaseSingleton.class.php';

class Register
{
    public function register($first_name, $last_name, $email, $password, $birthDate)
    {
        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $selectDataBase = 'use 221b_test';
        $insertQuery = "call registerUser('$first_name','$last_name','$email','$hashedPassword','$birthDate')";

        $connection->query($selectDataBase);
        $result = $connection->query($insertQuery);

        return $result;
    }

    public function updateUserData( $first_name, $last_name, $email, $password, $birthDate)
    {
        try {
            $connectionInstance = DatabaseSingleton::getInstance();
            $connection = $connectionInstance->getConnection();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare(
            "select updateUser(:firstName,:lastName,:email,:password,:birthDate)"
        );
        $result->bindParam(":firstName", $first_name);
        $result->bindParam(":lastName", $last_name);
        $result->bindParam(":email", $email);
        $result->bindParam(":password", $hashedPassword);
        $result->bindParam(":birthDate", $birthDate);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->execute();
            return $row;
        } catch (PDOException $ex) {
            return  $ex;
        }
    }
}

// saidaquimacaco