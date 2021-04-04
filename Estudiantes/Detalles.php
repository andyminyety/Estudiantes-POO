<?php

require_once 'Student.php';
require_once '../Layout/Layout.php';
require_once '../Helpers/Utilities.php';
require_once 'ServiceCookies.php';

$Layout = new Layout();
$Service = new ServiceCookies();
$Utilities = new Utilities();

$Student = null;

if (isset($_GET["id"])) {

    $Student = $Service->GetById($_GET["id"]);
}

if (isset($_POST["Id"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Carreras"])&& isset($_POST["Materias"])&& isset($_FILES["ProfilePhoto"])) {


    $Student = new Estudiantes($_POST["Id"], $_POST["Nombre"], $_POST["Apellido"], $_POST["Carreras"],$_POST["Materias"], true);

    $Service->ver($Student);

    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
</head>
<body>

    <?php echo $Layout->printHeader() ?>

    <?php if ($Student == null) : ?>
        <h2>No existe este estudiante</h2>
    <?php else : ?>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 margin-bottom-5">
                <div class="card shadows">
                    <div class="modal-header text-white bg-dark">
                        <h5 class="modal-title h4" id="NuevoStudentLabel">Detalles</h5>
                    </div>
                
                <?php if($Student->ProfilePhoto == ""|| $Student->ProfilePhoto == null): ?>
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img card-img-top" src="<?= "../assets/Img/default.jpg"  ?>" width="100%" height="235" aria-label="Placeholder: Thumbnail">
                    </div>
                <?php else :?>
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img card-img-top" src="<?= "../assets/Img/Estudiante/" .  $Student->profilePhoto; ?>" width="100%" height="235" aria-label="Placeholder: Thumbnail">
                    </div>
                <?php endif;?>
                <div class="card-body">
                    <h5>Nombre</h5>
                    <p class="card-title"><?= $Student->Nombre ?> <?= $Student->Apellido ?></p>
                    <h5>Carrera</h5>
                    <p class="card-text"><?php echo $Utilities->Carreras[$Student->Carreras] ?></p>
                    <h5>Materias Favoritas</h5>
                    <?php $Space = $Student->Materias ?>
                    <?php $List = explode(",", $Space) ?>
                    <?php foreach ($List as $Li) : ?>
                        <p class="card-text"><?= $Li?></p>
                    <?php endforeach; ?>
                    <p style="text-align: right" class="card-text">
                    <strong>

                    <?php if($Student->Status): ?>

                        <span class="text-success">Activo</span>

                    <?php else:?>

                        <span class="text-danger">Inactivo</span>

                    <?php endif;?>

                    </strong>
                    </p>

                    <a href="../index.php" class="btn btn-dark float-end">Volver atras</a>
                </div>
            </div>
        </div>

<?php endif; ?>
    <?php echo $Layout->printFooter() ?>

</body>

</html>
