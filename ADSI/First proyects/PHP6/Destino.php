<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <title>Factura</title>
</head>

<body>
    <?php
    $valor = array(
        'Duitama' => 2000,
        'Paipa' => 3000,
        'Tunja' => 6000,
        'Bogota' => 22000,
        'Bucaramanga' => 34000,
        'Tame ' => 38000,
        'Saravena' => 40000,
        'Arauca' => 47000
    );
    foreach ($valor as $ciudad => $precio)
        if ($ciudad == $_POST['destino']) {
            if (1 == $_POST['pasajes']) {
                $unitario = $valor[$_POST['destino']]; //Valor unitaro del pasaje.
            } else {
                $unitario = $valor[$_POST['destino']] * 2; //precio 2 pasajes.
            }
        }
    ?>
    <div class="container p-3 my-3 bg-dark text-white">
        <h2>Factura de venta</h2>
        <label>Destino: </label> <?php echo  $destino = $_POST['destino'] . "<br>"; ?>
        <label>Valor unitario: </label> <?php echo  $unitario . "<br>"; ?>
        <label>Total: </label> <?php echo  $unitario . "<br>"; ?>
        <img src="https://www.autoboysa.com.co/images/logo-1.png" class="rounded size-3 pt-3 col-3" alt="Cinque Terre">
    </div>
</body>

</html>