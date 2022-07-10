<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\Register\Register.class.php';

class RegisterController 
{
    public function registerUSer($first_name,$last_name,$email,$password,$birthDate)
    {
        $registerModelInstace=new Register();
        return $registerModelInstace->register($first_name,$last_name,$email,$password,$birthDate);
    }

    public function updateUser($first_name,$last_name,$email,$password,$birthDate)
    {
        $registerModelInstace=new Register();
        return $registerModelInstace->updateUserData($first_name,$last_name,$email,$password,$birthDate);
    }
}

?>