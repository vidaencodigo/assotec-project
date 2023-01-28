<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>

<body>
    <div class="content">
        <section class="form_content">
            <h3>Confirma para eliminar</h3>
            <form method="post" action = "index.php?controller=schedule&action=delete_schedule">
                <input type="hidden" name="id_schedule" id="id_schedule" value="<?= $_REQUEST['idSchedule']; ?>">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
                <div class="buttons-group">
                    <button type="submit">Confirmar</button>
                    <a href="javascript:history.go(-1)">Cancelar</a>

                </div>
            </form>
        </section>
    </div>
</body>

</html>