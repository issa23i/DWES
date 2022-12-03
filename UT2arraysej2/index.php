<!DOCTYPE html>
<!--
2) Investiga cómo realizar el ejercicio anterior mediante 
un bucle while sin utilizar foreach. 
Usa alguna función de PHP para ir recorriendo los
elementos del array en cada iteración del bucle.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // con current y next (no me funciona)
        echo "<table>";
        echo "<h1> Con current y next value  y key</h1>";
        while ($valor = current($_SERVER)){
            echo "<tr><td> "
                    .key($_SERVER)
                    ."</td> <td> "
                    .$valor
                    ."</td></tr>";
            next($_SERVER);
        }
        echo "<h1> --con foreach -- </h1>";
        foreach ($_SERVER as $key => $value) {
            
            echo "<tr><td> {$key}  </td> <td>  {$value} </td></tr>";
        }
          echo "</table>";      
        ?>
        <h3><a href="<?= $_SERVER['PHP_SELF'] ?>" >RECARGAR PÁGINA</a></h3>
        
        
    </body>
</html>
