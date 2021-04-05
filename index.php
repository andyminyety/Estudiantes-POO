<?php

require_once 'Estudiantes/Student.php';
require_once 'Helpers/Utilities.php';
require_once 'Estudiantes/ServiceCookies.php';
require_once 'Layout/Layout.php';

$Layout = new Layout(true);
$Service = new ServiceCookies();
$Utilities = new Utilities();

$Students = $Service->GetList();

if(!empty($Students)){

    if(isset($_GET['Carreras'])){

        $Students = $Utilities->searchProperty($Students,'Carreras',$_GET['Carreras']);
    }
}

?>

<?php echo $Layout->printHeader(); ?>

<div class="row">
    <div class="col-md-9">
        <div>
            <div class="col-md-0 margin-left">
                <div class="btn-group">
                    <a class="btn btn-dark"><strong>Filtrar por:</strong></a>
                    <a href="index.php" class="btn btn-primary text-white"><strong>Todos</strong></a>
                    <a href="index.php?Carreras=1" class="btn btn-primary text-white"><strong>Redes</strong></a>
                    <a href="index.php?Carreras=2" class="btn btn-primary text-white"><strong>Software</strong></a>
                    <a href="index.php?Carreras=3" class="btn btn-primary text-white"><strong>Multimedia</strong></a>
                    <a href="index.php?Carreras=4" class="btn btn-primary text-white"><strong>Mecatrónica</strong></a>
                    <a href="index.php?Carreras=5" class="btn btn-primary text-white"><strong>Seguridad informática</strong></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 btn-group">
        <a class="btn btn-dark margin-bottom-17 margin-left-25" data-bs-toggle="modal" data-bs-target="#nuevo-student-modal">
        <strong>Agregar Estudiante</strong></a>
    </div>
</div>
        
<div class="row">

    <?php if (count($Students) == 0) : ?>

        <h2>No hay estudiante registrados</h2>

    <?php else : ?>

        <?php foreach ($Students as $key => $Student) : ?>
            <div class="col-md-4 margin-bottom-5">
                <div class="card shadows">
                    <div class="modal-header text-white bg-dark">
                        <h5 class="modal-title h4" id="NuevoStudentLabel">Estudiante</h5>
                    </div>
                    
                    <?php if($Student->ProfilePhoto == ""|| $Student->ProfilePhoto == null): ?>
                        <img class="bd-placeholder-img card-img-top" src="<?= "assets/Img/default.jpg"  ?>" width="100%" height="235" aria-label="Placeholder: Thumbnail">
                    <?php else :?>
                        <img class="bd-placeholder-img card-img-top" src="<?= "assets/Img/Estudiante/" .  $Student->ProfilePhoto; ?>" width="100%" height="235"aria-label="Placeholder: Thumbnail">
                    <?php endif;?>
                    <div class="card-body">
                        <h5>Nombre</h5>
                        <p class="card-title"><?= $Student->Nombre ?> <?= $Student->Apellido ?></p>
                        <h5>Carrera</h5>
                        <p class="card-text"><?php echo $Utilities->Carreras[$Student->Carreras] ?></p>
                        <p style="text-align: right" class="card-text">
                        <strong>

                        <?php if($Student->Status): ?>

                            <span class="text-success">Activo</span>

                        <?php else :?>

                            <span class="text-danger">Inactivo</span>

                        <?php endif;?>
                        </strong>
                        </p>

                        <a href="Estudiantes/Detalles.php?id=<?= $Student->Id ?>" class="btn btn-success float-end margin-left-1">Detalles</a>
                        <a href="Estudiantes/Editar.php?id=<?= $Student->Id ?>" class="btn btn-primary float-end margin-left-1">Editar</a>
                        <a href="#" data-id="<?= $Student->Id ?>" class="btn btn-danger btn-delete float-end margin-left-1">Eliminar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="modal fade" id="nuevo-student-modal" tabindex="-1" aria-labelledby="NuevoStudentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content margin-top-10">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="NuevoStudentLabel">Nuevo Estudiante</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form enctype="multipart/form-data" action="Estudiantes/Agregar.php" method="POST">
                    <div class="mb-3">
                        <label for="Student-Nombre" class="form-label">Nombre del Estudiante</label>
                        <input name="Nombre" type="text" class="form-control" id="Student-Nombre">

                    </div>
                    <div class="mb-3">
                        <label for="Student-Apellido" class="form-label">Apellido del Estudiante</label>
                        <input name="Apellido" type="text" class="form-control" id="Student-Apellido">
                    </div>
                    <div class="mb-3">
                        <label for="Student-Carreras" class="form-label">Carrera</label>
                        <select name="Carreras" class="form-select" id="Student-Carreras">
                            <option value="">Seleccione una opcion</option>
                            <?php foreach ($Utilities->Carreras as $value => $text) : ?>

                                <option value="<?php echo $value; ?>"> <?= $text ?> </option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Materias" class="form-label">Materias Favoritas</label>
                        <input name="Materias" type="text" class="form-control" id="Materias" placeholder="Separar cada materia por coma">
                    </div>

                    <div class="mb-3">
                        <label for="photo">Foto de perfil</label>
                        <input name="ProfilePhoto" type="file" class="form-control" id="photo">
                    </div>
                
                <button type="submit" class="btn btn-primary float-end margin-left-1">Guardar</button>
                <button type="button" class="btn btn-dark float-end margin-left-1" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $Layout->printFooter(); ?>

<script src="assets/JavaScript/site/index/index.js"></script>