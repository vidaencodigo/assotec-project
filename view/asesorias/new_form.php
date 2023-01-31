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


            </section>
            <section class="profile_details col-8 ">
                <div class="row">
                    <div class="col-8">

                        <h3>Registra nueva asesoria <br> <?= $materia->name; ?></h3>
                        <hr>
                        <form action="index.php?controller=asesorias&action=post_save" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="idmateria" value="<?= $_REQUEST['subjectId'] ?>">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                            <div class="mb-3">
                                <select class="form-select" name="tipo" aria-label="Tipo Asesoria">

                                    <option value="presencial">Presencial</option>
                                    <option value="virtual">Virtual</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="salon" class="form-label">Salón</label>
                                <input type="text" class="form-control" id="salon" name="salon" placeholder="Salón">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Descripción</label>
                                <textarea class="form-control" id="desc" name="descripcion" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Liga sesión</label>
                                <input type="url" class="form-control" id="url" name="url" placeholder="http://www.example.com">
                            </div>
                            <div class="mb-3">
                                <label for="day" class="form-label">Selecciona Día</label>
                                <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Hora inicio</label>
                                <input type="time" class="form-control" name="horaInicio" id="horaInicio" value="09:00" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hora fin</label>
                                <input type="time" class="form-control" name="horaFin" id="horaFin" value="09:00" required>
                            </div>
                            <button type="submit" class="btn btn-success">Generar</button>
                        </form>
                    </div>


                </div>




            </section>
        </div>
    </div>
    <?php require_once "./view/usuarios/modal_delete.php" ?>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>