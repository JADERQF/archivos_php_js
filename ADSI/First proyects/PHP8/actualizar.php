<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <title>Actualizar</title>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT FROM * empleados WHERE id = $id";
        $result = mysqli_query($conn, $query); //mysqli_query -> conn = conexion, query = consulta, a la BD.
        if (mysqli_num_rows($result) == 1) //mysqli_num_rows -> Obtiene el número de fila de un conjunto de resultados.
        {
            $row = mysqli_fetch_array($result); // fecth_array -> recorre $result.
            $nombre = $row['Nombre'];
            $apellido = $row['Apellido'];
            $email = $row['Email'];
            $clave = $row['Contrasena'];
        }
    }
    ?>
    <div class="container p-4">
        <h3>Actualizar los datos del empleado</h3>
        <form action="editarDatos.php id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
                <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
                <input name="apellido" type="text" class="form-control" value="<?php echo $apellido; ?>">
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <input name="clave" type="password" class="form-control" value="<?php echo $clave; ?>">
            </div>
            <button class="btn btn-danger" name="actualizar">Actualizar</button>
        </form>
    </div>

</body>

</html>