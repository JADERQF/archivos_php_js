<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv n="X-UA-compatible" content="id=edge">
    <title>Operador 1</title>
</head>

<body>
    <form method="GET">
        <input type="text" name="estudiante" placeholder="Digite su nombre">
        <br>
        <input type="text" name="nota1" placeholder="1ra nota">
        <br>
        <input type="text" name="nota2" placeholder="2da nota">
        <br>
        <input type="text" name="nota3" placeholder="3ra nota">
        <br>
        <input type="text" name="nota4" placeholder="4ta nota">
        <br>
        <input type="text" name="nota5" placeholder="5ta nota">
        <br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
    <?php
    if (isset($_GET["enviar"]) && !empty($_GET["enviar"])) {

        $estudiante = $_GET["estudiante"];
        print "El estudiante es: " . $estudiante."<br>";
        $notas = array("nota1" => $_GET["nota1"],
        "nota2" => $_GET["nota2"],
        "nota3" => $_GET["nota3"],
        "nota4" => $_GET["nota4"],
        "nota5" => $_GET["nota5"]);
        $promedio = 0;

        foreach( $notas as $iterador)
        {
            $promedio += $iterador;
        }
        echo 'El promedio de nota es ' . $promedio / count($notas);

    }
    ?>

</body>

</html>