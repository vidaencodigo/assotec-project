<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión</title>
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                            <a class="nav-link active" aria-current="page" href="index.php?controller=users&action=index">Registrate</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="container__personal">
        <section class="login_form">
            <div class="center__items">

                <h3>Bienvenido</h3>
                <h4>Ingresa tus credenciales</h4>
            </div>
            <form action="index.php?controller=login&action=login" method="post"  class="needs-validation" novalidate>
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="usuarioHelp" required autofocus>
                    <div id="usuarioHelp" class="form-text">No compartas tu usuario y contraseña con nadie.</div>
                    <div class="invalid-feedback">
                        Usuario requerido
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">
                        Contraseña Requerida
                    </div>
                </div>
                <div class="center__items">
                    <button type="submit" class="btn btn-max-width btn-primary">Inicia sesión</button>
                </div>
                <div class="errors py-2">
                    <?php if (isset($_REQUEST['msg'])) : ?>
                        <?php if ($_REQUEST['msg'] == "success") : ?>
                            <div class="alert alert-success" role="alert">
                                Se creo usuario, puede iniciar sesión
                            </div>
                        <?php endif; ?>
                        <?php if ($_REQUEST['msg'] == "pwderr") : ?>
                            <div class="alert alert-danger" role="alert">
                                Credenciales invalidas, vuelve a intentar
                            </div>
                        <?php endif; ?>

                        <?php if ($_REQUEST['msg'] == "usrerr") : ?>
                            <div class="alert alert-danger" role="alert">
                                Usuario dado de baja, para reactivar comunicate con un administrador
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </form>
        </section>
    </div>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
</body>

</html>