<?php

session_start();
date_default_timezone_set("Europe/Paris");

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "karting";

try  
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'class/class.user.php';
include_once 'class/class.accident.php';
include_once 'class/class.kart.php';
$user = new USER($DB_con);
$karts=new KART($DB_con);


?>