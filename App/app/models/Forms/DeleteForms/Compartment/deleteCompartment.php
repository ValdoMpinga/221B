<?php
session_start();

require_once 'C:\xampp\htdocs\App\221B\app\models\Compartment\CompartmentController.php';
$environment=$_SESSION['mainEnvironment'];

if (!$_SESSION['email']) {
    header("location:../../../Environment/EnvironmentView.php?environmentName=$environment");
    echo 'fail';
    exit;
}

$compartmentControllerInstance = new CompartmentController();
$result = $compartmentControllerInstance->deleteCompartment($_SESSION['email'],$_SESSION['mainEnvironment'], $_GET['compartmentName']);

header("location: ../../../Environment/EnvironmentView.php?environmentName=$environment");

?>
