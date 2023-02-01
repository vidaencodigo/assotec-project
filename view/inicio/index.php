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

        .bg-purple {
            background-color: #7952b3;
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

                    <?php if (isset($_SESSION['session'])) : ?>
                        <?php if ($_SESSION['rol'] == "administrador") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=nuevo_maestro_view">Registrar maestros</a>
                            </li>
                        <?php endif; ?>
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

                        <?php endif; ?>
                        <?php if ($_SESSION['rol'] == "alumno") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=maestros&action=get_asesores">Lista de asesores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=inscribe&action=get_asesorias">Mis asesorias</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <?php if (isset($_SESSION['session'])) : ?>
                            <li class="nav-item">

                                <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ir a mi perfil">
                                    <?= $_SESSION['username'] ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=login&action=logout">Cierra sesión</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=login&action=index">Inicia sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=index">Registrate</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>


            </div>
        </div>
    </nav>

    <div class="container">
        <section class="action text-center py-5">
            <h1>ASESOTEC</h1>
            <p>Aprende con asesores tu materia favorita</p>
        </section>

        <?php if (!isset($_SESSION['session'])) : ?>
            <?php require_once "view/inicio/wellcome.php"; ?>
        <?php else : ?>
            <?php if ($_SESSION['rol'] == "alumno") : ?>

                <div class="row d-flex justify-content-center">
                    <h3 class="text-center my-5">Maestros</h3>
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <?php require_once "view/inicio/lista_maestros.php"; ?>
                    </div>
                </div>


            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/tooltips.js"></script>
</body>

</html>