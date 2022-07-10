<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\DatabaseConnection\DatabaseSingleton.class.php';

final class Apointment
{

    public function getUsersApointment($compartmentId, $userEmail, $environmentName)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select *from apointment where compartment_id=:compartmenttId;");
        $result->bindParam(":compartmenttId", $compartmentId);
        // $result->bindParam(":environmentName", $environmentName);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetchAll();

        return $row;
    }

    public function insertUserApointment($compartmentId,$environmentName, $userEmail, $apointmentName, $apointmentType,$ApointmentDescription,$apointmentPicture)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare("select createApointment
        (
            :compartmentId,
            (select environment_id from environment where environment_name=:environmentName and user_id=(select user_id  from user where email=:email)),
            (select user_id  from user where email=:email),
            :apointmentName,
            :apointmenType,
            :apointmenDescription,
            sysdate(),
            :apointmentPicture)
             as apointmentOutput");
        $result->bindParam(":compartmentId", $compartmentId);
        $result->bindParam(":environmentName", $environmentName);
        $result->bindParam(":email", $userEmail);
        $result->bindParam(":apointmentName", $apointmentName);
        $result->bindParam(":apointmenType", $apointmentType);
        $result->bindParam(":apointmenDescription", $ApointmentDescription);
        $result->bindParam(":apointmentPicture", $apointmentPicture);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();

        return $row['apointmentOutput'];
    }


    public function deleteUserApointment($apointmentId)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $result = $connection->prepare(
            "select deleteApointment(:apointmentId) as apointmentOutput"
        );
        $result->bindParam(":apointmentId", $apointmentId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->execute();
        $row = $result->fetch();
        return  $row['apointmentOutput'];
    }

    //     _user_id int,
    //     _environment_id int,
    //     _compartment_id varchar(100),
    //     _newCompartmentName varchar(100),
    // _newCompartmentDescription varchar(100)

    public function updateUserApointment($userEmail, $compartmentId, $apointmentId,$apointment_name, $apointment_description,$apointment_type,$apointment_picture)
    {

        $connectionInstance = DatabaseSingleton::getInstance();
        $connection = $connectionInstance->getConnection();

        $selectDataBase = 'use 221b_test';
        $connection->query($selectDataBase);

        $fetchedUserId = $connection->prepare('select user_id from user where email=:email');
        $fetchedUserId->bindParam(":email", $userEmail);
        $fetchedUserId->setFetchMode(PDO::FETCH_ASSOC);

        $userId = $fetchedUserId->execute();
        $userId = $fetchedUserId->fetch();

        $result = $connection->prepare(
            "select updateApointment
            (
            :compartmentId,
            :userId,
            :apointmentId,
            :apointmentName,
            :apointmentDescription,
            :apointmentType,
            :apointmentPicture
        )as apointmentUpdate"
        );

        // $apointment_name, $apointment_description,$apointment_type,$apointment_picture
        $result->bindParam(":compartmentId", $compartmentId);
        $result->bindParam(":userId", $userId['user_id']);
        $result->bindParam(":apointmentId", $apointmentId);
        $result->bindParam(":apointmentName", $apointment_name);
        $result->bindParam(":apointmentDescription", $apointment_description);
        $result->bindParam(":apointmentType", $apointment_type);
        $result->bindParam(":apointmentPicture", $apointment_picture);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->execute();
        $row = $result->fetch();

        return $row['apointmentUpdate'];
    }

    
}
