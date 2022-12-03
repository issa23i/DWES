<?php
include "funciones.php"
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
FUNCDIN QUE RECIBE UN ARRAY DE NUEMERO Y DOS LIMITE S (SUPERIOR E INFERIOR) QUE DEVELVE 
OTRO ARRAY CON LOS ELEMENTOS ENTRE AMBOS LIMITES
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $max=8;
        $min=1;
        $arraySalida=[1,4,10,8,3];
        printArray($arraySalida);
        filtraVector($arraySalida, $max, $min)
        ?>
    </body>
</html>
