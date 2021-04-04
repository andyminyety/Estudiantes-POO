<?php

require_once 'Student.php';
require_once '../Helpers/Utilities.php';
require_once 'ServiceCookies.php';

$Service = new ServiceCookies();

    $DeleteId = isset($_GET["id"]);

    if($DeleteId){

        $Service->Delete($_GET["id"]);
    }

    header("Location: ../index.php");
    exit();
?>