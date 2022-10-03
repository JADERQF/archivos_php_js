<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <title>SenaEmpleados</title>
</head>
<body>
    <div class="col">
        <h3 class="container">Datos empleados</h3>
        <table class="table table-bordered">
        <thead>
            <td>Id</td>
            <td>Nombre</td>
            <td>Apellido</td>
        <td>Email</td>
        <td>Acciones</td>
    </thead>
    <tbody>
        <?php
        require_once "conexion.php"; //Realzamos la conexion coen el conexion en PHP8
        $query = "SELECT * FROM empleados";
        $result_tasks = mysqli_query($conn, $query);//consulta(query) mendiante la conexion $conn en una misma función.
            
            while($row = mysqli_fetch_assoc($result_tasks)){ //fetch_assoc muestra la inf de la tabla empleados.
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['Nombre'];?></td>
                    <td><?php echo $row['Apellido'];?></td>
                    <td><?php echo $row['Email'];?></td>
                    <td>
                        <a href="eliminar.phpid=<?php echo $row['id']?>" class="btn btn-danger">ELiminar</a> 
                        <a href="actualizar.phpid=<?php echo $row['id'];?>" class="btn btn-danger">Actualizar</a>
                        <!-- .phpid= es el número del id a eliminar -->
                    </td>                             
                </tr>
               
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>