<?php
require_once 'conexion.php';
if(isset($_POST['actualizar'])){
    $id = $_GET['id'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $clave = $_POST['Contrasena'];

    $query = "UPDATE empleados SET Nombre='$nombre', Apellido='$apellido', Email='$email', Contrasena='$clave' WHERE id='$id'";
    mysqli_query($conn,$query);
    header('Location: seleccionar.php');
}
?>