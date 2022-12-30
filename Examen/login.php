<?php
require_once 'funciones.php';

if(isset($_POST['login'])){
    $nombre_usuario = $_POST['usuario'];
    $pass_usuario = $_POST['clave'];
    if(comprobar_usuario($nombre_usuario, $pass_usuario)){
        session_start();
        $_SESSION['usuario'] = $nombre_usuario;
        header('Location:sesiones_1.php');
    } elseif ($nombre_usuario='' && $pass_usuario=''){
        $aviso = 'Debe introducir usuario y contraseña';
    } else {
        session_start();
        $_SESSION['usuario'] = $nombre_usuario;
        $aviso = 'Usuario y contraseña incorrectos';
    }
}

// comprobar si viene de una página sin loguear
if(isset($_REQUEST['login'])){
    if($_REQUEST['login']==0){
        $aviso = 'Haga login para continuar';
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de login</title>
		<meta charset = "UTF-8">
                <link href="sesiones.css" rel="stylesheet" type="text/css">
	</head>
	<body>	
		<?php if(isset($aviso)){
			echo "<p class=aviso>$aviso</p>";
		}?>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			<label for = "usuario">Usuario</label> 
			<input id = "usuario" name = "usuario" type = "text">		
			<label for = "clave">Clave</label> 
			<input id = "clave" name = "clave" type = "password">					
			<input name='login' type = "submit">
		</form>
	</body>
</html>
