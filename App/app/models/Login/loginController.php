<?php

require_once  'C:\xampp\htdocs\App\221B\app\models\Login\Login.class.php';
class LoginController
{
    public function Login($email, $password)
    {
        $loginModelInstance=new Login();
        return $loginModelInstance->Login($email,$password);
    }

    public function getUsersCredential($email)
    {
        $loginModelInstance=new Login();
        return $loginModelInstance->getUsersCreds($email);
    }

    public function deactivateAccount($email)
    {
        $loginModelInstance=new Login();
        return $loginModelInstance->deactivateUserAccount($email);
    }
}
