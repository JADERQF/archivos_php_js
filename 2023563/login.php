<?php

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
session_start();//Inicia o continua la sesión mediante el metodo POST.

include('db.php'); //Incluye la Bd al php.

$query = "SELECT*FROM usuarios where Nombre = '$usuario' and contrasena = '$clave'"; //consulta
$resultado = mysqli_query($conexion, $query);//Realiza la consulta con la bd.

$filas = mysqli_num_rows($resultado); //Toma los datos 
if($filas){
    header("location:home.php");
}else{
    include("index.php");
    ?>
    <h3> Invalid username or password</h3>
    <?php
    
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>