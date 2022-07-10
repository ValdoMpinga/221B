<?php

require_once 'C:\xampp\htdocs\App\221B\app\models\Compartment\Compartment.php';


final class CompartmentController
{

    public function getCompartment($userEmail,$environmentName)
    {
        $compartmentModelInstance=new Compartment();
       
        return $compartmentModelInstance->getUsersCompartment($userEmail,$environmentName);
    }

    public function insertCompartment($environmentName,$userEmail,$compartmentName,$compartmentDescription)
    {
        $compartmentModelInstance=new Compartment();
       
        return $compartmentModelInstance->insertUserCompartment($environmentName,$userEmail,$compartmentName,$compartmentDescription);

    }
    public function deleteCompartment($userEmail,$environmentName,$compartmentName)
    {
        $compartmentModelInstance=new Compartment();
       
        return $compartmentModelInstance->deleteUserCompartment($userEmail,$environmentName,$compartmentName);
    }

    public function updateCompartment($environmentName, $userEmail, $compartmentName, $newCompartmentName, $newCompartmentDescription)
    {
        $compartmentModelInstance=new Compartment();
       
        return $compartmentModelInstance->updateUserCompartment($environmentName,$userEmail,$compartmentName, $newCompartmentName, $newCompartmentDescription);
    }
}

?>
