<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $filas=5;
        $columnas=6;
        echo '<table>';
        $indice = 0;
        while($indice<$filas){
            echo '<tr>';
                $indice2=0;
                while($indice2<$columnas){
                    
                    echo "<td>$indice - $indice2</td>";
                    $indice2++;
                }
            echo '</tr>';
            
            $indice++;
        }
        echo '</table>';
        
        ?>
    </body>
</html>
