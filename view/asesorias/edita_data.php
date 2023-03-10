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
                        <a class="nav-link active" aria-current="page" href="index.php?controller=categorias&action=show_index">Multimedia</a>
                    </li>


                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ir a mi perfil"><?= $_SESSION['username'] ?></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=login&action=logout">Cierra sesi??n</a>
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

                        <h3>Edita datos de asesoria <br> <?= $materia->name; ?></h3>
                        <hr>
                        <form action="index.php?controller=asesorias&action=post_edit" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="id_asesoria" value="<?= $asesoria->id; ?>">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                            <div class="mb-3">
                                <select class="form-select" name="tipo" aria-label="Tipo Asesoria">
                                    <option value="<?= $asesoria->tipo ?? '' ?>" selected><?= $asesoria->tipo ?? '' ?></option>
                                    <option value="presencial">Presencial</option>
                                    <option value="virtual">Virtual</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="salon" class="form-label">Sal??n</label>
                                <input type="text" class="form-control" id="salon" name="salon" placeholder="Sal??n" value="<?= $asesoria->salon  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Descripci??n</label>
                                <textarea class="form-control" id="desc" name="descripcion" rows="3" <?= $asesoria->descripcion  ?>></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Liga sesi??n</label>
                                <input type="url" class="form-control" id="url" name="url" placeholder="http://www.example.com" value="<?= $asesoria->url_sesion  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="day" class="form-label">Selecciona D??a</label>
                                <input type="date" class="form-control" name="day" id="day" value="<?= $asesoria->dia  ?>">
                            </div>

                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Hora inicio</label>
                                <input type="time" class="form-control" name="horaInicio" id="horaInicio" value="<?= $asesoria->inicio  ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hora fin</label>
                                <input type="time" class="form-control" name="horaFin" id="horaFin" value="<?= $asesoria->fin  ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="limimte" class="form-label">Limite de alumnos</label>
                                <input type="number" class="form-control" name="limite" id="horaFin" value="<?= $asesoria->limite  ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="index.php?controller=asesorias&action=get_quit&id=<?= $asesoria->id ?>" class="btn btn-warning">Quitar</a>
                        </form>
                    </div>


                </div>




            </section>
        </div>
    </div>


    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>