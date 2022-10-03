<!DOCTYPE html>
<html> 
    <head>
        <title>Unidad 2 - Ejemplo 6</title>
        <meta http-equiv="Content-Type" 
              content="text/html; charset=ISO-8859-1" />
    </head>
    <body> 
        <table>
            <?php
                $cabecera=array("<h3>Nombre</h3>","<h3>Tel&eacutefono</h3>","<h3>Direcci&oacuten</h3>",     
            "<h3>Fecha de cumplea&ntilde;os</h3>","<h3>Color</h3>","<h3>Significado</h3>");
                $jader=array("Jader Quiroz", "3014232551","Dg 50A #33-30","05/05/1997","Rojo","Amor");
                $jairo=array("Jairo Herrera","3134568404","Cr 3 B #44-07","19/03/1996","Azul","Firmeza");
                $joenis=array("Joenis Castro", "3222954987","Cl 73 #56-60","03/05/1995","Amarillo","Energ&iacutea y vida");
                $agenda=array($cabecera,$jader,$jairo,$joenis);
            foreach($agenda as $fila)
            {
                echo"<tr>";
                foreach($fila as $celda)
                {
                    echo"<td>";
                    echo"<td> $celda </td>";
                    echo"</td>";
                }
                
                echo"</tr>";
            }

            ?>

        </table>

   
        </body>
    </html>