<?php

require_once 'C:\xampp\htdocs\App\221B\app\models\Apointment\Apointment.php';

final class ApointmentController
{

    public function getApointment($compartmentId,$userEmail,$environmentName)
    {
        $apointmentModelInstance=new Apointment();
       
        return $apointmentModelInstance->getUsersApointment($compartmentId,$userEmail,$environmentName);
    }

    public function insertApointment($compartmentId,$environmentName, $userEmail, $apointmentName, $apointmentType,$ApointmentDescription,$apointmentPicture)
    {
        $apointmentModelInstance=new Apointment();
       
        return $apointmentModelInstance->insertUserApointment($compartmentId,$environmentName, $userEmail, $apointmentName, $apointmentType,$ApointmentDescription,$apointmentPicture);

    }

    public function updateApointment($userEmail, $compartmentId, $apointmentId,$apointment_name, $apointment_description,$apointment_type,$apointment_picture)
    {
        $apointmentModelInstance=new Apointment();

        return $apointmentModelInstance->updateUserApointment($userEmail, $compartmentId, $apointmentId,$apointment_name, $apointment_description,$apointment_type,$apointment_picture);

    }

    
    public function deleteApointment($apointmentId)
    {
        $apointmentModelInstance=new Apointment();

        return $apointmentModelInstance->deleteUserApointment($apointmentId);

    }

}

?>
