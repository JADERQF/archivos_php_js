<?php
  $unidades = array(
    'cm' => 100,
    'km' => 1000,
    'pie' => 3.28084,
    'inch' => 39.3701,
);
$resultado=0;
foreach($unidades as $convertir => $valor)
{
    if($convertir == $_POST['unidad'])
    {
        $resultado = $_POST['convertir']*$valor;
    }
}
if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){
}
echo "EL valor de metros a ".$_POST['unidad']." es: ".$resultado;
?>