<?php
require_once './funciones.php';
//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();

if (isset($_SESSION['visitas'])) {
    
    $visitasAnteriores=$_SESSION['visitas'];
   
}else{
    
    $_SESSION['visitas']=[];
    
}
  $_SESSION['visitas'][]= date("d-m-y H:i:s", time());


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <H3>SESION<H3>
                <form id="form_seleccion" action="log_out.php" method="post">
                     <input name="cerrarSesion" type="submit" value="Cerrar Sesion">
                </form>
                
              
                
         <?php if(isset($visitasAnteriores)):?>
                
                <?php foreach ($visitasAnteriores as $value):?>         
                    <p><?=$value?></p>
                <?php endforeach;?>
         <?php elseif($_REQUEST['borrar']):?>
                    <p>Visitas borradas</p>
        <?php else:?>
                <p>Bienvenido</p>        
         <?php endif;?>
               
                
            <form id="form_seleccion" action="borrarSesiones.php" method="post">    
                <input type="submit" name="borrarSesion" value="Borrar Sesiones">
            </form>
                
    </body>
</html>
