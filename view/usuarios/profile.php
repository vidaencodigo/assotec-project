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
                    <?php if ($_SESSION['rol'] == "maestro") : ?>
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=video&action=get_video_list">Mis Videos</a>
                        </li>

                    <?php endif; ?>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ir a mi perfil"><?= $_SESSION['username'] ?></a>

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

                <p>
                    <a href="index.php?controller=users&action=get_new_password_form" class="btn btn-primary" style="width: 100%;">Cambiar contraseña</a>
                </p>
            </section>
            <section class="profile_details col-8 ">
                <div class="row">
                    <div class="col-6">
                        <strong>Editar perfil</strong>
                        <form method="post" action="index.php?controller=users&action=profile_update" class="needs-validation" novalidate>
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $usuario->name ?>" required>
                                <div class="invalid-feedback">
                                    Nombre requerido
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $usuario->last_name ?>" required>
                                <div class="invalid-feedback">
                                    Apellidos requerido
                                </div>
                            </div>
                            <?php if ($_SESSION['rol'] == 'alumno') : ?>
                                <div class="mb-3">
                                    <label for="semestreo" class="form-label">Semestre</label>
                                    <input type="text" class="form-control" name="semestre" id="semestre" value="<?= $usuario->semestre ?>" required>
                                    <div class="invalid-feedback">
                                        Semestre requerido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="carrera" class="form-label">Carrera</label>
                                    <input type="text" class="form-control" name="carrera" id="carrera" value="<?= $usuario->carrera ?>" required>
                                    <div class="invalid-feedback">
                                        Carrera requerido
                                    </div>
                                </div>
                            <?php endif; ?>
                            <p>
                                <button type="submit" class="btn btn-success" style="width: 100%;">Guardar cambios</button>
                            </p>

                            <p>
                                <a href="#" class="btn btn-danger" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Eliminar mi perfil</a>
                            </p>

                        </form>
                    </div>

                </div>


                <hr>
                <?php if ($_SESSION['rol'] == 'alumno') : ?>
                    Hola alumno
                <?php endif; ?>
                <?php if ($_SESSION['rol'] == 'maestro') : ?>
                    <h3>

                        Mis materias
                    </h3>
                    <?php if ($this->subject->get_all_active($usuario->id)) : ?>
                        <ul class="list-group">
                            <?php foreach ($user_subject as $materia) : ?>
                                <li class="list-group-item list-group-item-info"><?= $materia->name; ?>
                                    ||
                                    <a href="index.php?controller=schedule&action=get_form_schedule&subjectId=<?= $materia->id; ?>" class="btn btn-link"> Registrar o ver dias</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                <?php endif; ?>
            </section>
        </div>
    </div>
    <?php require_once "./view/usuarios/modal_delete.php" ?>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>