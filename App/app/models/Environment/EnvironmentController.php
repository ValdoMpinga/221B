<?php

require_once 'C:\xampp\htdocs\App\221B\app\models\Environment\Environment.class.php';


final class EnvironmentController
{

    public function getEnvironment($userEmail)
    {
        $environmentModelInstance=new Environment();
       
        return $environmentModelInstance->getUsersEnvironment($userEmail);
    }

    public function insertEnvironment($userEmail,$environmentName,$environmentDescription)
    {
        $environmentModelInstance=new Environment();
       
        return $environmentModelInstance->insertUserEnvironment($userEmail,$environmentName,$environmentDescription);
    }
}

?>
