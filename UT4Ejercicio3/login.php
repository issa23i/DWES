<?php
/////// CONEXIÓN ////////////////////////////////////////////
$msql = "mysql:dbname=dwes2;host=127.0.0.1";
$user = 'dwes2';
$pass = 'abc123.';
$mensaje = '';

try {
    $pdo = new PDO($msql, $user, $pass);
    
    // LOGINF
    if (isset($_POST['enviar'])) {
        $flag_nombre = false;
        $flag_clave = false;
        $nombre_usuario = $_POST['usuario'];
        $clave_usuario = md5($_POST['password']);
        $query_login = "SELECT * FROM `usuarios` WHERE usuario = :nombre_usuario AND password =  :clave_usuario";
        $resultado_login = $pdo->prepare($query_login);
        $resultado_login->execute(array(':nombre_usuario' => $nombre_usuario, ':clave_usuario' => $clave_usuario));
        if ($resultado_login->rowCount() > 0) {

            ///// CREAR SESIÓN

            session_start();
            $_SESSION['usuario'] = $nombre_usuario;

            /// REDIRIGIR
            header("Location: ./listado_familias.php");
        }
    }
    
    
     if (isset($nombre_usuario) && isset($clave_usuario)) {
         // Si falló el login
         if (!$flag_nombre || !$flag_clave) {
             $mensaje = 'Usuario o clave incorrecta';
         } else {
             $mensaje = 'Login Correcto';
         }
     }
     
} catch (PDOException $exc) {
    $mensaje_conexion = "<p>Falló la conexión" . $exc->getMessage() . "</p>";
}
$mensaje_conexion = "<p>Conexión realizada con éxito</p>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: login.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login Tienda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <div id='login'>
        <header>
            
        <div class="alert alert-info"><?= $mensaje_conexion?></div>
            <p><a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Login</a></p>
        </header>
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
            <fieldset >
                <legend>Login</legend>
                <div><span class='error'><?= $mensaje ?></span></div>
                <div class='campo'>
                    <label for='usuario' >Usuario:</label><br/>
                    <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
                </div>
                <div class='campo'>
                    <label for='password' >Contraseña:</label><br/>
                    <input type='password' name='password' id='password' maxlength="50" /><br/>
                </div>

                <div class='campo'>
                    <input type='submit' name='enviar' value='Enviar' />
                </div>
            </fieldset>
        </form>
    </div>
        <script src="script.js"></script>
</body>
</html>
</html>
