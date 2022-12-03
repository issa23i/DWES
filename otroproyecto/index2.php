<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->

        <?php
        // tirar dados
        $dado1 = mt_rand(1,6);
        $dado2 = mt_rand(1,6);
        $dado3 = mt_rand(1,6);
        $major = 0;
        $minor = 0;
        $text = 'error';
        
        // resto, max, min
        // etiquetas html fuera
       // echo <img src=\"ruta.dado$i-svg\">"";
       
        if($dado1 == $dado2 && $dado2 == $dado3){
            // si los tres son iguales trio
            // salida
            $text = '¡Trio!';
        } elseif ($dado1 == $dado2 || $dado1 == $dado3){
            // pareja 1,2 o 1,3
            // salida
            $text = '¡Pareja de !'.$dado1;
        } elseif ($dado2 == $dado3) {
            // pareja 2,3
            // salida
            $text = "¡Pareja de !$dado2";
        } else {
            if($dado1>$dado2){
                if($dado1 > $dado3){
                    $major = $dado1;
                    $minor = $dado2;
                } else {
                   $major = $dado3;
                   $minor = $dado1;
                }
            } else {
                if($dado2>$dado3){
                    $major = $dado2;
                    $minor = $dado3;
                } else {
                    $major = $dado3;
                    $minor = $dado2;
                }
            }
            $text = "El dado mayor es $major y el dado menor es $minor";
        }
           ?>
    <html>
        <head>
            
        </head>
        <body>
            <img src="./img/<?=$dado1?>.svg">
            <img src="./img/<?=$dado2?>.svg">
            <img src="./img/<?=$dado3?>.svg">
           <p> <?= $text?> </p>
           <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>"><p>INICIO</p></a>
        </body>
    </html>
        
          
      

