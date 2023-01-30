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
            </section>
            <section class="profile_details col-8 ">
                <h3>Cambiar contraseña</h3>
                <p>
                    <?= $usuario->name . " " . $usuario->last_name ?>
                </p>


                <hr>
                <form action="index.php?controller=users&action=new_password" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                    <div class="mb-3">
                        <label for="password_actual" class="form-label"><strong>Contraseña actual</strong> </label>
                        <input type="password" class="form-control" name="password_actual" id="password_actual" autofocus required>
                        <div class="invalid-feedback">
                            Contraseña requerida
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="invalid-feedback">
                            Contraseña requerida
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Repite Contraseña</label>
                        <input type="password" class="form-control" name="r_password" id="r_password" required>
                        <div class="invalid-feedback">
                            Repite Contraseña requerida
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                <?php if (isset($_REQUEST['msg'])) : ?>
                    <div class="my-3">
                        <?php if ($_REQUEST['msg'] == "pwdaerr") : ?>
                            <div class="alert alert-danger" role="alert">
                                Contraseña actual no coincide
                            </div>
                        <?php endif; ?>
                        <?php if ($_REQUEST['msg'] == "pwderr") : ?>
                            <div class="alert alert-danger" role="alert">
                                Contraseñas no coinciden
                            </div>
                        <?php endif; ?>

                        <?php if ($_REQUEST['msg'] == "success") : ?>
                            <div class="alert alert-success" role="alert">
                                Contraseña modificada
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            </section>
        </div>
    </div>

    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
    <script src="assets/js/tooltips.js"></script>
</body>

</html>