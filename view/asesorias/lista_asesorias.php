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
                    <?php if ($_SESSION['rol'] == "alumno") : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=maestros&action=get_asesores">Lista de asesores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=inscribe&action=get_asesorias">Mis asesorias</a>
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


            </section>
            <section class="profile_details col-8 ">
                <h3 class="my-5 text-center">Mis asesorias</h3>
                <table class="table">
                    <thead>
                        <th>Maestro</th>
                        <th>Materia</th>
                        <th>Dia</th>
                        <th>Hora inicio</th>
                        <th>Hora Fin</th>
                        <th>-</th>
                    </thead>
                    <tbody>
                        <?php if ($asesorias) : ?>
                            <?php foreach ($asesorias as $asesoria) : ?>
                                <tr>
                                    <td><?= $this->user->get_by_id($asesoria->maestro)->name ?><br><?= $this->user->get_by_id($asesoria->maestro)->last_name ?></td>
                                    <td><?= $this->subject->get_by_id($asesoria->materia)->name ?></td>
                                    <td><?= $asesoria->dia ?></td>
                                    <td><?= $asesoria->inicio ?></td>
                                    <td><?= $asesoria->fin ?></td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Desinscribe</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>