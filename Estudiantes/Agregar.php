<?php

require_once 'Student.php';
require_once '../Helpers/Utilities.php';
require_once 'ServiceCookies.php';

$Service = new ServiceCookies();
$Utilities = new Utilities();

    if(isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Carreras"])&& isset($_POST["Materias"]) && isset($_FILES["ProfilePhoto"])){

        $Student = new Estudiantes(0,$_POST["Nombre"],$_POST["Apellido"],$_POST["Carreras"],$_POST["Materias"],true);
        $Service->Add($Student);

        header("Location: ../index.php");
    }

?>