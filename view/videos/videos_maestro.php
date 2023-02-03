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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=video&action=get_video_list">Mis Videos</a>
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
            <section class=" col-8 py-5">
                <h4 class="text-center">Lista de videos</h4>
                <div class="d-grid gap-2 mx-auto">
                    <?php if ($videos) : ?>
                        <div class="row row-cols-3">


                            <?php foreach ($videos as $video) : ?>
                                <?php
                                $imagen = new GetThumbnail;
                                $imagen->url = urldecode($video->url);
                                $imagen->get_thumbnail();
                                ?>
                                <div class="col ">
                                    <div class="card shadow p-3 mb-5 bg-body rounded " style="width: 18rem;">
                                        <img src="<?php echo $imagen->thumbnail ?>" class="card-img-top" alt="minuatura">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $video->titulo ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php echo $video->descripcion ?>
                                            </p>
                                        </div>
                                        
                                        <div class="card-body">
                                            <a href="<?=urldecode($video->url);?>" target="_blank" class="card-link">Ver video</a>
                                            
                                        </div>
                                    </div>
                                    

                

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
        </div>
    </div>
    

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>