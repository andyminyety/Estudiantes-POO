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

if (isset($_POST["Id"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Carreras"])&& isset($_POST["Materias"]) && isset($_FILES["ProfilePhoto"])) {

    $Status = ($_POST["Status"] == "activo") ? true : false;

    $Student = new Estudiantes($_POST["Id"], $_POST["Nombre"], $_POST["Apellido"], $_POST["Carreras"],$_POST["Materias"], $Status);

    $Service->Edit($Student);

    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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
                        <h5 class="modal-title h4" id="NuevoStudentLabel">Editar Estudiante</h5>
                    </div>
                
                <form enctype="multipart/form-data" action="Editar.php" method="POST">
                <input type="hidden" name="Id" value="<?= $Student->Id ?>">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="Student-Nombre" class="form-label">Nombre del estudiante</label>
                        <input name="Nombre" value="<?php echo $Student->Nombre ?>" type="text" class="form-control" id="Student-Nombre">
                    </div>

                    <div class="mb-3">
                        <label for="Student-Apellido" class="form-label">Apellido del Estudiante</label>
                        <input name="Apellido" value="<?php echo $Student->Apellido ?>" type="text" class="form-control" id="Student-Apellido">
                    </div>

                    <div class="mb-3">
                        <label for="Student-Carreras" class="form-label">Carrera</label>
                        <select name="Carreras" class="form-select" id="Student-Carreras">
                            <option value="">Seleccione una opción</option>
                            <?php foreach ($Utilities->Carreras as $value => $text) : ?>

                                <?php if ($value == $Student->Carreras) : ?>
                                    <option selected value="<?php echo $value; ?>"> <?= $text ?> </option>
                                <?php else : ?>
                                    <option value="<?php echo $value; ?>"> <?= $text ?> </option>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Materias" class="form-label">Materias Favoritas</label>
                        <input name="Materias"value="<?php echo $Student->Materias ?>" type="text" class="form-control" id="Materias">
                    </div>
                    <div class="mb-3">
                    <?php if($Student->ProfilePhoto == "" || $Student->ProfilePhoto == null): ?>
                        <img class="bd-placeholder-img card-img-top" src="<?= "../assets/Img/default.jpg" ?>" height="210" aria-label="Placeholder: Thumbnail">
                    <?php else :?>
                        <img class="bd-placeholder-img card-img-top" src="<?= "../assets/Img/Estudiante/" . $Student->ProfilePhoto; ?>" width="100%" height="235" aria-label="Placeholder: Thumbnail">
                    <?php endif;?> 
                    </div>

                    <div class="mb-3">
                        <label for="Photo">Foto de perfil</label>
                        <input name="ProfilePhoto" type="file" class="form-control" id="Photo">
                    </div>

                    <div class="form-check form-check-inline">
                        
                    <?php if($Student->Status): ?>
                        
                        <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="activo" checked>
      
                    <?php else: ?>

                        <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="activo">
                        
                    <?php endif;?>

                    <label class="form-check-label margin-bottom-5" for="inlineRadio">Activo</label>
                    </div>

                    <div class="form-check form-check-inline">
                        
                    <?php if($Student->Status): ?>
                        
                        <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="inactivo">
      
                    <?php else: ?>
                        
                        <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="inactivo" checked>

                    <?php endif;?>

                    <label class="form-check-label margin-bottom-5" for="inlineRadio2">Inactivo</label>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end margin-left-1 margin-top-2">Guardar</button>
                        <a href="../index.php" class="btn btn-dark float-end margin-left-1 margin-top-2 margin-bottom-5">Volver atras</a>
                    </div>
                </form>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php echo $Layout->printFooter() ?>

</body>
</html>