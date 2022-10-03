<!DOCTYPE html>
<html>
    <head>
        <title>Unidad 2 - Ejemplo 8 - 1</title>
        <meta http-equiv="Content-Type" 
              content="text/html; charset=ISO-8859-1" />
    </head>
    <body>
        <h3>Ejemplo de arreglo con llaves num&eacute;ricas</h3>
        <?php
        /* En este programa se va a especificar la forma de
         * declarar arreglos y acceder a la información que contiene
         */
        //Arreglo con llaves numéricas
        $listadoProductosCodigoNombre = array(
            1234 => "Arroz x libra",
            2341 => "Frasco aceite x 1000 mls.",
            2345 => "Mantequilla x 250 grs."
        );
        ?>
        <p>
            <?php
            $codigoProducto = 1234;
            echo "El producto con c&oacute;digo $codigoProducto es: "
            . "$listadoProductosCodigoNombre[$codigoProducto]";
            ?>
        </p> 
        <h3>Ejemplo de arreglo con llaves alfanum&eacute;ricas</h3>
        <?php
        //Arreglo con llaves alfanuméricas
        $listadoDiasActividad = array(
            "lunes" => "caminar",
            "martes" => "sentadillas",
            "miercoles" => "flexiones",
            "jueves" => "abdominales",
            "viernes" => "estiramiento",
            "sabado" => "saltar lazo",
            "domingo" => "futbol"
        );
        ?>
        <p>
            <?php
            $dia = 'miercoles';
            echo "La actividad para el d&iacutea $dia es: "
            . "$listadoDiasActividad[$dia]";
            ?>
        </p> 
        <?php
        //Arreglo con llaves numéricas autodefinidas
        $listadoEstudiantes = array(
            "Ardila, Pablo",
            "Benitez, Nancy",
            "Cepeda, Juan",
            "Castro, Luis",
            "Soto, Carlos"
        );
        ?>
        <h3>Ejemplo de arreglo con llaves num&eacute;ricas autodefinidas</h3>
        <p>
            <?php
            echo "El primer estudiante de la lista es: "
            . "$listadoEstudiantes[0] <br />";
            echo "El segundo estudiante de la lista es: "
            . "$listadoEstudiantes[1] <br />";
            echo "El tercer estudiante de la lista es: "
            . "$listadoEstudiantes[2] <br />";
            echo "El cuarto estudiante de la lista es: "
            . "$listadoEstudiantes[3] <br />";
            echo "El quinto estudiante de la lista es: "
            . "$listadoEstudiantes[4] <br />";
            ?>
        </p> 
    </body>
</html>
