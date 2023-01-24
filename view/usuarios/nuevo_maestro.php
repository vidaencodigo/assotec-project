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
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>


                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=profile"><?= $_SESSION['username'] ?></a>

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
        <section class="action py-5">
            <h4 class="text-center">Registro nuevos usuarios(Maestros)</h4>
            <div class="d-grid gap-2 col-6 mx-auto">

                <form method="post" action="index.php?controller=users&action=save_maestro" class="needs-validation" novalidate>

                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <div class="invalid-feedback">
                            Nombre requerido
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" required>
                        <div class="invalid-feedback">
                            Apellido(s) requerido
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo eléctronico</label>
                        <input type="mail" class="form-control" name="mail" id="mail" required>
                        <div class="invalid-feedback">
                            Correo requerido
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                        <div class="invalid-feedback">
                            Nombre de usuario requerido
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="invalid-feedback">
                            Contraseña requerido
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Repite Contraseña</label>
                        <input type="password" class="form-control" name="r_password" id="r_password" required>
                        <div class="invalid-feedback">
                            Repite Contraseña requerido
                        </div>
                    </div>

                    <div class="center__items">
                        <button type="submit" style="width:100%" class="btn btn-max-width btn-primary">Guardar</button>
                    </div>

                    <div class="errors py-2">
                        <?php if (isset($_REQUEST['msg'])) : ?>
                            <?php if ($_REQUEST['msg'] == "success") : ?>
                                <div class="alert alert-success" role="alert">
                                    Usuario guardado
                                </div>
                            <?php endif; ?>

                            <?php if ($_REQUEST['msg'] == "usrerr") : ?>
                                <div class="alert alert-warning" role="alert">
                                    Usuario/mail ya registrado
                                </div>
                            <?php endif; ?>

                            <?php if ($_REQUEST['msg'] == "pwderr") : ?>
                                <div class="alert alert-danger" role="alert">
                                    Contraseñas no coinciden vuelve a intentar
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </section>



    </div>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
</body>

</html>