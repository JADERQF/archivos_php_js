    <?php

    if (isset($_POST["enviar"]) && !empty($_POST["enviar"])){
        
        $entrada = $_POST["entrada"];
        $salida = $_POST["salida"];
        if($entrada <= $salida)
        {
            
            if(1 == date("h",strtotime($salida)-strtotime($entrada)))
            {
                $minutos=date("i",strtotime($salida)-strtotime($entrada));
                echo "Total de minutos trabajados: ".$minutos;
                echo "<br>";   
                echo "Valor a pagar: ".$minutos*25;
            }
            else
            {
                $hora = date("h",strtotime($salida)-strtotime($entrada));
                $minutos = date("i",strtotime($salida)-strtotime($entrada));
                $total = ($hora-1)*60 + $minutos;           
                echo "Total de minutos trabajados: ".$total;
                echo "<br>";
                echo "Valor a pagar: ".$total*25;
            }   
                
                

        }
    }
    ?>