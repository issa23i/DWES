<?php
$start = 16;
$end = 254;
$step = 12;
$numColores = range($start, $end, $step);
$intensidad = 0;
$colores = ["red", "green", "blue"];
$rgb="(0,0,0)";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <?php foreach ($colores as $value) :?>
                    <th>Código Color</th>
                    <th>Color</th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($numColores); $i++) :?>
                <tr>
                <?php foreach ($colores as $value):?>
                <?php switch ($value) {
                            case "red":
                                $rgb = "rgb($numColores[$i],0,0)";
                                break;
                            case "green":
                                $rgb = "rgb(0,$numColores[$i],0)";
                                break;
                            case "blue":
                                $rgb = "rgb(0,0,$numColores[$i])";
                                break;
                            default:
                                $rgb= "grey";
                                break;
                        } ?>
                    <td><?=$rgb?></td>
                    <td style="background-color:<?=$rgb?>;color:white"><?=$value?></td>
                <?php endforeach;  ?>
                </tr>
           <?php endfor;  ?>
            </tbody>
        </table>

    </body>
</html>
