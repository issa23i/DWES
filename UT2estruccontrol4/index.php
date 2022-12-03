<?php 
include 'formulario_edad.php'
?>
<!DOCTYPE html>
<!--
4) Descarga el siguiente archivo formulario_edad.php que incluye 
un formulario:
▪ Si se ha pulsado el botón enviando del formulario 
(comprobarlo con función isset), obtén los valores introducidos 
en los cuadros de texto mediante la variable superglobal $_POST.
▪ Evalúa la edad introducida por el usuario en el formulario dado 
y muestra un mensaje en la misma página debajo del formulario. 
Según la edad introducida, se mostrará el siguiente mensaje:
▫ Si la edad es menor que 10: “Eres muy joven ” 
y el nombre del usuario en rojo y negrita.
▫ Entre 10 y 20: “Qué mala edad tienes ” 
y el nombre del usuario en rojo y negrita.
▫ Entre 21 y 30: “Estás en el mejor momento ” 
y el nombre del usuario en rojo y negrita.
▫ Mayor que 30: “Qué bien te veo ” 
y el nombre del usuario en verde y negrita.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // recoger variables con isset
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        $estilo = "rojo";
        $msg='';
        /**
        *  ctype_digit es para que compruebe digito a digito 
        * si es un número, si intentas meter una coma o un punto
        * no lo coge
        */
        if($usuario == ''){
            $msg = "El campo está vacío. Debe introducir un nombre";
        } elseif ($edad == ''){
            $msg = "El campo está vacío. Debe introducir una edad";
        } else {
            if (isset($_POST['enviando'])){
                if (!ctype_digit($edad)){
                    $msg = "Error, no insertó un número válido";
                    } else {
                        if ($edad < 10){
                            $msg = "Eres muy joven <span>{$usuario}</span>";
                        } elseif ($edad >=10 && $edad <20) {
                            $msg = "Qué mala edad tienes <span>{$usuario}</span>";
                        } elseif ($edad >=20 && $edad <30) {
                            $msg = "Estás en el mejor momento <span>{$usuario}</span>";
                        } else {
                            $msg = "Qué bien te veo <span>{$usuario}</span>";
                            $estilo = "verde";
                        }
                }
            }
        }
        
       
        
        
        ?>
        <p class="<?=$estilo?>"><?=$msg?></p>
        
    </body>
</html>
