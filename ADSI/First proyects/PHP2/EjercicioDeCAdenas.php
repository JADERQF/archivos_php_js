<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $clave = "dapv0102";
    echo "Contraseña original: ".$clave;
    echo "<br>";
    //CIFRADO MD5
    $cifrado = md5($clave);
    echo "Contraseña encriptada en md5: ".$cifrado;
    echo "<br>";
    //CIFRADO SHA1
    $cifrado2 = sha1($clave);
    echo "Contraseña encriptada en Sha1: ".$cifrado2;
    ?>
    <?php
    $cadena = "Diego-Palacio.5;28;41;08";
    $reemplazo = str_replace("-"," ",$cadena);
    $cadena = str_replace("."," ",$reemplazo);
    $reemplazo = str_replace(";","",$cadena);
    echo "Nueva cadena es: ".$reemplazo;

    ?>
</body>
</html>