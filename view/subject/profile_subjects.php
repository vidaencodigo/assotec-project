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
                        <a class="nav-link active" aria-current="page" href="#">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=subject&action=get_index">Registrar materias</a>
                        <style>
                            * {
                                padding: 0;
                                margin: 0;
                                box-sizing: border-box;
                                text-decoration: none;
                                list-style: none;
                            }

                            .content {
                                width: 100%;

                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            .form_content {
                                width: 450px;
                                margin-top: 5em;
                            }

                            .form_content h3 {
                                text-align: center;
                            }

                            .buttons-group {
                                margin-top: 5em;
                                width: 100%;
                                display: flex;
                                justify-content: space-around;
                            }
                        </style>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=subject&action=get_user_subjects">Mis materias</a>
                    </li>


                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <style>
                            * {
                                padding: 0;
                                margin: 0;
                                box-sizing: border-box;
                                text-decoration: none;
                                list-style: none;
                            }

                            .content {
                                width: 100%;

                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            .form_content {
                                width: 450px;
                                margin-top: 5em;
                            }

                            .form_content h3 {
                                text-align: center;
                            }

                            .buttons-group {
                                margin-top: 5em;
                                width: 100%;
                                display: flex;
                                justify-content: space-around;
                            }
                        </style>
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
        <style>
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                text-decoration: none;
                list-style: none;
            }

            .content {
                width: 100%;

                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form_content {
                width: 450px;
                margin-top: 5em;
            }

            .form_content h3 {
                text-align: center;
            }

            .buttons-group {
                margin-top: 5em;
                width: 100%;
                display: flex;
                justify-content: space-around;
            }
        </style>
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
                    <div class="col-12">

                        <?php if ($_SESSION['rol'] == 'alumno') : ?>
                            Hola alumno
                        <?php endif; ?>
                        <?php if ($_SESSION['rol'] == 'maestro') : ?>
                            <h3>

                                Mis materias
                            </h3>
                           <?php require_once"view/subject/table_subject.php";?>
                        <?php endif; ?>
                    </div>


                </div>
                <hr>
                <?php if (isset($_REQUEST['msg'])) : ?>
                    <?php if ($_REQUEST['msg'] =="success_delete_subject") : ?>
                        <div class="alert alert-success">
                            Se borro una materia correctamente
                        </div>
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