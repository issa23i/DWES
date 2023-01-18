<?php
$usurio="empresa";
$password="abc123.";
$host="127.0.0.1";
$bd="empresa";
if (isset($_REQUEST['redirigido'])) {  
        $mesanje_login="Debes poner el usuario y contaseña";   
}
if (isset($_REQUEST['cerrar'])) {  
        $mesanje_login="Sesion cerrada";   
}
try {
    $conexion_cadena=("mysql:host=$host;dbname=$bd");
    $conexion = new PDO($conexion_cadena,"$usurio","$password");
    echo 'conectado';
    if (isset($_POST['consultar'])) {
        
        $usuario=$_POST['usuario'];
        $clave=md5($_POST['clave']);
        
        $consultaUsuario="SELECT nombre,clave FROM usuarios WHERE Nombre=:nombre and Clave=:clave";
        $resultadoUsuario=$conexion->prepare($consultaUsuario);
        $parametros=[":nombre"=>$usuario,":clave"=>$clave];
        $resultadoUsuario->execute($parametros);
        
        if ($resultadoUsuario->rowCount()>0) {  
            
            session_start();
            $_SESSION['usuario']=$usuario;
            //hacer otra pagina
            header('Location:sesion2_parte3.php');
    
        }else{
            $mesanje_login="Usuario o contraseña incorrecta";
        }
        
    }
    
} catch (Exception $ex) {
    die($ex->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Formulario de login</title>
<meta charset = "UTF-8">
</head>
<body>
    <?php if(isset($err)){
    echo "<p> Revise usuario y contraseña</p>";
    }?>
    
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
      
        <label for = "usuario">Usuario</label>
        <input name = "usuario" type = "text">
        <label for = "clave">Clave</label>
        <input name = "clave" type = "password">
        
        <input type = "submit" name="consultar" value="Consultar">
    </form>
  
             
    <?php if( isset( $mesanje_login)):?>
             <p><?=$mesanje_login?></p>
    <?php endif;?>
</body>
</html>
