<?php

$condicion = $_POST["geometria"];

        if (isset($_POST["submit"]) && !empty($_POST["submit"])){
            
            $numero = $_POST["number-1"];
            $numero2 = $_POST["number-2"];
            if($condicion == "Área Cuadrado")
            {
                echo "El resultado del ".$condicion." es: ".$numero*$numero."<br>";
                echo "Segundo resultado ".$condicion." es: ".$numero2*$numero2;

            }
        }
if (isset($_POST["submit"]) && !empty($_POST["submit"])){

    $numero = $_POST["number-1"];
    $numero2 = $_POST["number-2"];
    if($condicion == "Área Triángulo")
    {
        echo "El resultado del ".$condicion." es: ".($numero*$numero2)/2;        
    }
}
if (isset($_POST["submit"]) && !empty($_POST["submit"])){

    $numero = $_POST["number-1"];
    $numero2 = $_POST["number-2"];
    if($condicion == "Área Rectángulo")
    {
        echo "El resultado del ".$condicion." es: ".$numero*$numero2;        
    }
}
if (isset($_POST["submit"]) && !empty($_POST["submit"])){

    $numero = $_POST["number-1"];
    $numero2 = $_POST["number-2"];
    if($condicion == "Área Círculo")
    {
        echo "El resultado del ".$condicion." es: ".pi()*$numero."<br>"; 
        echo "El resultado del ".$condicion." es: ".pi()*$numero2; 
        
    }
}
?>