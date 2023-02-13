<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesotec</title>

    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="libs/fontawesome/css/all.css">
    <script src="libs/fontawesome/js/all.js"></script>
    <style>
        h1 {
            font-size: 52px;
        }

        .action p {
            color: #737373;
            font-size: 30px;
        }

        .tmb {
            width: 90px;
            height: auto;
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
                <p>
                    <?= $usuario->user ?>
                </p>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#elementoModal">Nuevo Video</a>

                </div>
            </section>
            <section class="profile_details col-8 ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?controller=categorias&action=show_index"><?= $categoria->nombre ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $categoria->id ?></li>
                    </ol>
                </nav>
                <hr>
                <table class="table">
                    <thead>
                        <th>Miniatura</th>
                        <th>Titulo</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php if ($elementos_categoria) : ?>
                            <?php foreach ($elementos_categoria as $categoria) : ?>
                                <?php
                                $imagen = new GetThumbnail;
                                $imagen->url = urldecode($categoria->url);
                                $imagen->get_thumbnail();
                                ?>
                                <tr>
                                    <td>
                                        <img class="tmb" src="<?php echo $imagen->thumbnail ?>" alt="minuatura">
                                    </td>
                                    <td><?= $categoria->titulo ?></td>
                                    <td>
                                        <a href="<?= urldecode($categoria->url) ?>" target="_blank" class="btn btn-secondary">Ver video</a>
                                        <!--
                                        <a href="#" class="btn btn-outline-danger">Eliminar (<?= $categoria->id_video ?>)</a>
                            -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>


    <div class="modal fade" id="elementoModal" tabindex="-1" aria-labelledby="elementoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriaModalLabel">Nuevo Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php?controller=categorias&action=post_guarda_elemento" class="needs-validation" novalidate>

                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                        <input type="hidden" name="id_categoria" value="<?= $categoria->id ?>">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" required autofocus>
                            <div class="invalid-feedback">
                                Titulo requerido
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>

                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL de YouTube</label>
                            <input type="url" class="form-control" name="url" id="url" placeholder="https://youtube.com/example" required>
                            <div class="invalid-feedback">
                                URL requerido
                            </div>
                        </div>





                        <div class="center__items">
                            <button type="submit" style="width:100%" class="btn btn-max-width btn-primary">Guardar</button>
                        </div>

                        <div class="errors py-2">
                            <?php if (isset($_REQUEST['msg'])) : ?>
                                <?php if ($_REQUEST['msg'] == "success") : ?>
                                    <div class="alert alert-success" role="alert">
                                        Video guardado
                                    </div>
                                <?php endif; ?>


                            <?php endif; ?>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>


</body>

</html>