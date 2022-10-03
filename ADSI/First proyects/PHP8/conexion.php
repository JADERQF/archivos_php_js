<?php
 $servername = "localhost";
 $username = "root";
 $password = "Conexion1";
 $db = "senaempleados";

// Create connection con mysql
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

$conn -> set_charset("utf8"); //permite introducir caracteres especiales.
?>