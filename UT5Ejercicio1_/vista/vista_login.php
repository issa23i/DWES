
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: login.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login Tienda</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/tienda.css"/>
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