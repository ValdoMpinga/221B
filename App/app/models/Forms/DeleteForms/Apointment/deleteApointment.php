<?php
session_start();

require_once 'C:\xampp\htdocs\App\221B\app\models\Apointment\ApointmentController.php';

if (!$_SESSION['email']) {
    header('location: C:\xampp\htdocs\App\221B\app\models\Compartment\Compartment.view.php');

    exit;
}

$apointmentControllerInstance = new ApointmentController();
$result = $apointmentControllerInstance->deleteApointment($_GET['apointmentId']);

$id=$_GET['compartmentId'];
$name=$_GET['compartmentName'];
header("location: ../../../Compartment/Compartment.view.php?compartmentId=$id&compartmentName=$name");

?>

