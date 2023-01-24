<!DOCTYPE html>
<html lang="en">

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
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['session'])) : ?>
                        <?php if ($_SESSION['rol'] == "administrador") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=nuevo_maestro_view">Registrar maestros</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['rol'] == "maestro") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Agenda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Registrar materias</a>
                            </li>

                        <?php endif; ?>
                        <?php if ($_SESSION['rol'] == "alumno") : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Lista de asesores</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <?php if (isset($_SESSION['session'])) : ?>
                            <li class="nav-item">

                                <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile">
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

        <section class="action text-center py-5">
            <h4>Para iniciar, registrate o inicia sesión</h4>
            <div class="d-grid gap-2 col-4 mx-auto">
                <a href="index.php?controller=users&action=index" type="button" class="btn btn-lg btn-primary">Registrate</a>
                <a href="index.php?controller=login&action=index" type="button" class="btn btn-lg btn-success">Inicia sesión</a>
            </div>
        </section>
        <section class="info  d-flex justify-content-center pt-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="text-center">

                            Conocenos
                        </h3>
                        <p>TecNM virtual es un espacio de integración de elementos de tipos de escenarios de seguimiento académico
                            fuera del aula, tecnologías de apoyo para la labor docente, plataformas educativas para la implementación de
                            aulas virtuales, bibliotecas virtuales y contenido de apoyo, y tutoriales ágiles de capacitación para el uso
                            de herramientas..</p>

                    </div>
                    <div class="col">
                        <h3 class="text-center">

                            Misión
                        </h3>
                        <p>Formar integralmente profesionales competitivos de la ciencia, la tecnología y otras áreas de conocimiento, comprometidos con el
                            desarrollo económico, social, cultural y con la sustentabilidad del país..</p>
                    </div>
                    <div class="col">
                        <h3 class="text-center">

                            Visión
                        </h3>
                        <p>El TecNM es una institución de educación superior tecnológica de vanguardia, con reconocimiento internacional por el destacado
                            desempeño de sus egresados y por su capacidad innovadora en la generación y aplicación de conocimientos.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>