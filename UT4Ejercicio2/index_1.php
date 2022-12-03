<?php
//setcookie
$date = getdate();
$hh = $date['hours'];
$mm = $date['minutes'];
$ss = $date['seconds'];
$wd = $date['weekday'];
$md = $date['mday'];
$mo = $date['month'];
$yy = $date['year'];
$hora = " a las $hh:$mm:$ss del $wd, $md de $mo de $yy";
setcookie('hora',$hora, time()+ 3600*24);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(!isset($_COOKIE['hora'])):?>
        <p> ¡Bienvenida!</p> 
        <?php else :?>
        <p>¡Hola! La última vez que estuviste por aquí fué <?=$_COOKIE['hora'];?></p>
        <?php endif; ?>
    </body>
</html>
