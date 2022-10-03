    <?php
    require_once "conexion.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM 'empleados' WHERE 'empleados'.'id' = '$id'";
        if($conn -> query($query)){
            echo "Usuario eliminado";
        }else{
            echo "<br>Error: no se pudo eliminar el usuario";
        }
    }else{
        echo "Error: no se pudo procesar la petición";
    }
    ?>
