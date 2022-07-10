<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\DatabaseConnection\DatabaseSingleton.class.php';

final class Compartment
{

    public function getUsersCompartment($userEmail, $environmentName)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select *from compartment where user_id=(select user_id from user where email=:email) 
        and environment_id=(select environment_id from environment where environment_name=:environmentName  and user_id=(select user_id from user where email=:email));");
        $result->bindParam(":email", $userEmail);
        $result->bindParam(":environmentName", $environmentName);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetchAll();

        return $row;
    }

    public function insertUserCompartment($environmentName, $userEmail, $compartmentName, $compartmentDescription)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select createCompartment((select environment_id from environment where environment_name=:environmentName and user_id=(select user_id  from user where email=:email)),(select user_id  from user where email=:email),:compartmentName,:compartmentDescription,true,sysdate()) as compartmentOutput");
        $result->bindParam(":environmentName", $environmentName);
        $result->bindParam(":email", $userEmail);
        $result->bindParam(":compartmentName", $compartmentName);
        $result->bindParam(":compartmentDescription", $compartmentDescription);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        if (strcmp($row['compartmentOutput'], 'Os compartimnento criado deve inexistente e de nome diferente do seu ambiente') == 0)
            return false;
        else
            return true;
    }


    public function deleteUserCompartment($userEmail,$environmentName, $compartmentName)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare(
            "select deleteCompartement(:email,:environmentName,:compartmentName)"
        );
        $result->bindParam(":environmentName", $environmentName);
        $result->bindParam(":email", $userEmail);
        $result->bindParam(":compartmentName", $compartmentName);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->execute();

        if ($row)
            return true;
        else
            return true;
    }


    public function updateUserCompartment($environmentName, $userEmail, $compartmentName, $newCompartmentName, $newCompartmentDescription)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $fetchedUserId = $connection->prepare('select user_id from user where email=:email');

        $fetchedEnviromentId = $connection->prepare("select environment_id from environment where environment_name=:environmentName 
        and user_id=(select user_id from user where email=:email)");

        $fetchedCompartmentId = $connection->prepare("select compartment_id from compartment where compartment_name=:compartmentName
        and user_id= (select user_id from user where email=:email) and environment_id=
        (select environment_id from environment where environment_name= :environmentName and user_id=(select user_id from user where email=:email))");

        $fetchedUserId->bindParam(":email", $userEmail);

        $fetchedEnviromentId->bindParam(":environmentName", $environmentName);
        $fetchedEnviromentId->bindParam(":email",$userEmail);

        $fetchedCompartmentId->bindParam(":compartmentName",$compartmentName);
        $fetchedCompartmentId->bindParam(":email",$userEmail);
        $fetchedCompartmentId->bindParam(":environmentName", $environmentName);

        $fetchedUserId->setFetchMode(PDO::FETCH_ASSOC);
        $fetchedEnviromentId->setFetchMode(PDO::FETCH_ASSOC);
        $fetchedCompartmentId->setFetchMode(PDO::FETCH_ASSOC);

        $uId=$fetchedUserId->execute();
        $eId=$fetchedEnviromentId->execute();
        $cId=$fetchedCompartmentId->execute();

        $uId=$fetchedUserId->fetch();
        $eId=$fetchedEnviromentId->fetch();
        $cId=$fetchedCompartmentId->fetch();

        $result = $connection->prepare(
            "select updateCompartement
            (
            :userId,
            :envId,
            :compId,
            :compartmentNewName,
            :compartmentNewDescription
        )as compartmentUpdate"
        );

        $result->bindParam(":userId", $uId['user_id']);
        $result->bindParam(":envId", $eId['environment_id']);
        $result->bindParam(":compId", $cId['compartment_id']);
        $result->bindParam(":compartmentNewName", $newCompartmentName);
        $result->bindParam(":compartmentNewDescription", $newCompartmentDescription);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->execute();
        $row = $result->fetch();

        return $row['compartmentUpdate'];
    }
}
