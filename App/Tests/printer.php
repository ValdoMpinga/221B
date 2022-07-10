<?php
//File used for urgent console printing

require_once  'C:\xampp\htdocs\App\221B\Tests\DatabaseSingleton.class.php';

//DB connectipon
$connectionInstance=DatabaseSingleton::getInstance();
$connection=$connectionInstance->getConnection();

$password='crazyDiamond';//user password
$mail='crazyDiamond';//user email

$dataFetchedFromDataBase=array();

$selectDataBase = 'use 221b_test';
// $selectQuery = "select password from user where email =$mail)";

/***Database selectiom */
$connection->query($selectDataBase);

$result = $connection->prepare("select password from user where email=:mail");
$result->bindParam(":mail",$mail);
$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();
$row=$result->fetch();

echo  'is :' .$row['email'];

//password_verify($password, (string) $userPassword);
?>