<?php
session_start();//Inicia o continua la sesión mediante el metodo POST.

include('db.php'); //Incluye la Bd al php.

$nombre = $_POST['txtnombre'];
$apellido = $_POST['txtapellido'];
$email = $_POST['txtemail'];
$contra = $_POST['txtpassword'];

//Verificiar el email y evitar duplicicdad
$sql1 = "select * from usuarios where Email= \"$_POST[txtemail]\""; //query del email.

$resultado = mysqli_query($conexion, $sql1);//Realiza la consulta con la bd.
//$sql = $conexion->query($sql1); // guardo la consulta de $sql1.
while ($r = $resultado->fetch_array()) //fecth_array recorre el registro de las tablas $sql.
{

    if ($r ==TRUE) {
        echo "<script>alert(\"Email ya registrado\");window.location='signup.php';</script>";
    }
    else{

        // Create database por php.
        $sql = "INSERT INTO usuarios(nombre, apellido, email, contrasena) VALUES('$nombre','$apellido','$email','$contra')";
        
        if ($conexion->query($sql) === TRUE) {
            header("location:home.php");
        }
        else {
            echo "Error creating database: " . $conexion->error; // $conn.error muestra cuales son los errores de la conexion
        }
    }
}
mysqli_free_result($re);

?>
