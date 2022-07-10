<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\DatabaseConnection\DatabaseSingleton.class.php';

final class Environment
{

    public function getUsersEnvironment($userEmail)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select environment_name from environment where user_id=(select user_id from user where email=:email)");
        $result->bindParam(":email", $userEmail);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetchAll();

        return $row;
    }
    
    public function insertUserEnvironment($userEmail, $environmentName, $environmentDescription)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select createEnvironment((select user_id from user where email=:email),:environmentName,:environmentDescription,1,sysdate()) as environmentOutput");
        $result->bindParam(":email", $userEmail);
        $result->bindParam(":environmentName", $environmentName);
        $result->bindParam(":environmentDescription", $environmentDescription);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        if (strcmp($row['environmentOutput'],'Este ambiente ja existe') == 0)
            return false;
        else
            return true;
    }
}
