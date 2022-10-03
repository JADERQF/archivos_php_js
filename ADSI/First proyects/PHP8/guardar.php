<?php
require_once 'conexion.php';

$nombre = $_POST['txtnombre'];
$apellido = $_POST['txtapellido'];
$email = $_POST['txtemail'];
$contra = $_POST['txtpassword'];

//Verificiar el email y evitar duplicicdad
$sql1 = "select * from usuarios where Email= \"$_POST[txtemail]\""; //query del email.

$sql = $conn->query($sql1); // guardo la consulta de $sql1.
while ($r = $sql->fetch_array()) //fecth_array recorre el registro de las tablas $sql.
{

    if ($r ==TRUE) {
        echo "<script>alert(\"Email ya registrado\");window.location='seleccionar.php';</script>";
    }
    else{

        // Create database por php.
        $sql = "INSERT INTO empleados(nombre, apellido, email, contrasena) VALUES('$nombre','$apellido','$email','$contra')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Usuario creado con exito";
        }
        else {
            echo "Error creating database: " . $conn->error; // $conn.error muestra cuales son los errores de la conexion
        }
    }
}
?>
