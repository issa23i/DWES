<?php
require_once 'funciones.php';

comprobarSession();


if ( isset($_SESSION['visitas'])){
    $visitas_anteriores = $_SESSION['visitas'];

}else {
    $_SESSION['visitas']=[];
}
$_SESSION['visitas'][]= getdate(); // date('formato',time())
// [date('d-m-Y H:i:s',time())]   

// logout

if(isset($_POST['logout'])){
    logout_session();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="./logout.php" method="post">
            <input type="submit" name="logout" value="Cerrar Sesión">
        </form>
        <form action="./borrar.php" method="post">
            <input type="submit" name="borrar_visitas" value="Borrar visitas">
        </form>
        <?php if(isset($visitas_anteriores)):  ?>
            <?php foreach ($visitas_anteriores as $visita) :?>
        <p><?=$visita?></p>
            <?php endforeach; ?>
        <?php elseif($_REQUEST['borrar']): ?>
        <p>Borrado correctamente</p>
        <?php endif; ?>
        
    </body>
</html>
