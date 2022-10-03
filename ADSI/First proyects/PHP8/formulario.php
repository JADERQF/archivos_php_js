<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <title>Usuario</title>
</head>

<body>
    <h1 class="container">Gestion de usuario</h1>
    <form action="" method="POST">
        <div class="container my-4 form-group">
            <div class="form-group">
                <label for=""> Usuario</label>
                <input class="form-control" type="text" name="txtnombre" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
                <label for="">Contraseña</label>
                <input class="form-control" type="password" name="txtpassword" placeholder="Contraseña usuario">
            </div>
            <div class="form-check-inline">
                <a class="btn btn-light" name="acceder">Acceder</a    >
            </div>
            <div class="form-check-inline">
                <a href="registrar.php" class="btn btn-success" name="registrar">Nuevo</a>
            </div>
        </div>
    </form>
</body>

</html>