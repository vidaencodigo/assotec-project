<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
    </style>
</head>


<body>
    <div class="container">
        <section class=" d-flex mt-5 justify-content-center">
            <div class="card p-2" style="width: 24rem;">
                <h3>Confirma para desinscribir</h3>
                <form method="post" action="index.php?controller=inscribe&action=post_quit">
                    <input type="hidden" name="id" id="id" value="<?= $_REQUEST['id']; ?>">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                    <div class="d-flex justify-content-between mt-5">
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                        <a href="javascript:history.go(-1)" class="btn btn-link">Cancelar</a>

                    </div>
                </form>
            </div>

        </section>
    </div>
    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form_validate.js"></script>
</body>

</html>