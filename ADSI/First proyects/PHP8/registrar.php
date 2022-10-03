<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <title>Registro</title>
</head>

<body>
    <h1 class="container">Registro de usuario</h1>
    <form action="guardar.php" method="POST">
        <div class="container my-4 form-group">
            <div class="form-group">
                <input class="form-control"type = "text" name ="txtnombre" placeholder="Nombre de usuario" required>
              </div>
              <div class="form-group">
                <input class="form-control" type = "text" name ="txtapellido" placeholder="Apellido usuario" required>
              </div>
            <div class="form-group">
                <input class="form-control" type = "email" name ="txtemail" placeholder="Gmail usuario" required>
              </div>
              <div class="form-group">
                  <input class="form-control" type = "password" name ="txtpassword" placeholder="Contraseña usuario" required>
              </div>
              <div class="form-group">
                <input class="btn btn-success" type="submit" value="Registrar" name="registrar">
              </div>
            </div>
        </form>
</body>

</html>