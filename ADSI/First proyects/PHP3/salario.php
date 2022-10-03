<?php

$condicion = $_POST["salario"];

if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){

    $salario = $_POST["txt-salario"];
    if($condicion =="Sindicalizado")
    {
        echo "Empleado ".$condicion."<br>";
        echo "Salario actual ".$salario."<br>";
        echo "Salario con incremento ".$salario*(1.20);
        
    }
}
if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){

    $salario = $_POST["txt-salario"];
    if($condicion == "De confianza")
    {
        echo "Empleado ".$condicion."<br>";
        echo "Salario actual ".$salario."<br>";
        echo "Salario con incremento ".$salario*(1.10);
        
    }
}

if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){

    $salario = $_POST["txt-salario"];
    if($condicion == "Alto directivo")
    {
        echo "Empleado ".$condicion."<br>";
        echo "Salario actual ".$salario."<br>";
        echo "Salario con incremento ".$salario*(1.05);
        
    }
}

if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){

    $salario = $_POST["txt-salario"];
    if($condicion == "Ejecutivo")
    {
        echo "Empleado ".$condicion."<br>";
        echo "Salario actual ".$salario."<br>";
        echo "No aplica descuento";
        
    }
}
?>