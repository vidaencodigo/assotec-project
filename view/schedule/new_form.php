<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesotec</title>

    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <style>
        h1 {
            font-size: 52px;
        }

        .action p {
            color: #737373;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Asesotec</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=asesorias&action=get_all_asesorias">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=subject&action=get_index">Registrar materias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=subject&action=get_user_subjects">Mis materias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=video&action=get_form">Nuevo Video</a>
                    </li>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile"><?= $_SESSION['username'] ?></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=login&action=logout">Cierra sesión</a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mx-auto mt-5">

            <section class="profile col-4 text-center">
                <?php if ($usuario->profile_image) : ?>
                    <img src="data:image/png;base64,<?= base64_encode($usuario->profile_image) ?>" class="img-thumbnail" alt="Imagen de perfil">
                <?php else : ?>
                    <div style="margin:auto; display:flex; align-items:center;justify-content:center; width:200px; height:200px; border-radius:50%; background-color:#737373; color:#fff;">
                        no image
                    </div>
                    <br>

                <?php endif; ?>
                <p style="font-size: 14px;">
                    <a href="index.php?controller=users&action=change_image_profile">

                        Cambiar imagen
                    </a>
                </p>

                <p>
                    <?= $usuario->user ?>
                </p>
                <p>
                    <?= $usuario->mail ?>
                </p>


            </section>
            <section class="profile_details col-8 ">
                <h5 class="text-center">Registro de Horario para la materia <br> <?= $subject->name; ?></h5>
                <div class="row">
                    <div class="col-8">

                        <form method="post" action="index.php?controller=schedule&action=post_save_schedule" class="needs-validation" novalidate>
                            <input type="hidden" name="id_materia" id="id_materia" value="<?= $subject->id; ?>">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                            <div class="mb-3">
                                <label for="day" class="form-label">Selecciona Día</label>
                                <select class="form-select" name="day" id="day" aria-label="Selecciona día" required>

                                    <option value="lunes">Lunes</option>
                                    <option value="martes">Martes</option>
                                    <option value="miercoles">Miercoles</option>
                                    <option value="jueves">Jueves</option>
                                    <option value="viernes">Viernes</option>
                                    <option value="sabado">Sabado</option>
                                    <option value="domingo">Domingo</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Hora inicio</label>
                                <input type="time" class="form-control" name="horaInicio" id="horaInicio" value="15:00" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hora fin</label>
                                <input type="time" class="form-control" name="horaFin" id="horaFin" value="15:00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Día</button>
                            <div class="errors py-2">
                                <?php if (isset($_REQUEST['msg'])) : ?>
                                    <?php if ($_REQUEST['msg'] == "success") : ?>
                                        <div class="alert alert-success" role="alert">
                                            Dia guardado
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($_REQUEST['msg'] == "time") : ?>
                                        <div class="alert alert-warning" role="alert">
                                            Hora de inicio no puede ser mayor o igual a la hora final
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </form>

                    </div>

                    <div class="col-4">
                        <a href="index.php?controller=asesorias&action=get_new_form&subjectId=<?= $_REQUEST['subjectId']; ?>" class="btn btn-success"> Generar asesoria</a>
                    </div>


                </div>
                <?php if ($schedule) : ?>
                    <table class="table">
                        <thead>
                            <th>Dia</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>

                            <?php foreach ($schedule as $day) : ?>
                                <tr>
                                    <td><?= $day->dia; ?></td>
                                    <td><?= $day->horaInicio; ?></td>
                                    <td><?= $day->horaFin ?></td>
                                    <td><a href="index.php?controller=schedule&action=get_delete_view&idSchedule=<?= $day->id; ?>" class="btn btn-danger">Quitar</a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php endif ?>
            </section>
        </div>
    </div>
    <?php require_once "./view/usuarios/modal_delete.php" ?>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
</body>

</html>