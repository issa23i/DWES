<?php
$dsn = 'mysql:dbname=empresa;host=127.0.0.1';
$username = 'root';
$password = 'rootroot';
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Falló la conexión" . $e->getTraceAsString() . "\n";
}
echo '<p class="alert alert-info">Conexión realizada con éxito</p>';

// DATOS DEL USUARIO CONSULTADO:
if (isset($_POST['enviar_cod_usuario'])) {
    $codigo_usuario = $_POST["Codigo"];
}
if (isset($codigo_usuario)) {
    $query_usuario = "SELECT * FROM usuarios WHERE Codigo= $codigo_usuario";
    $resultado = $pdo->query($query_usuario);
    $usuario = $resultado->fetch();
}

// ARRAY USUARIOS
$query_usuarios = 'SELECT * FROM usuarios';
$resultado = $pdo->query($query_usuarios);
$usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

// LOGIN
if (isset($_POST['enviar_login'])) {
    $flag_nombre = false;
    $flag_clave = false;
    $nombre_usuario = $_POST['Nombre'];
    $clave_usuario = $_POST['Clave'];
    foreach ($usuarios as $value) {
        if ($nombre_usuario == $value['Nombre']) {
            $flag_nombre = true;
        }
        if ($clave_usuario == $value['Clave']) {
            $flag_clave = true;
        }
    }
}

// ARRAY DE USUARIOS
$query = "SELECT * FROM empleados";
$resultado = $pdo->query($query);
$array_empleados = $resultado->fetchAll(PDO::FETCH_ASSOC);

//INSERTAR USUARIOS
if (isset($_POST['enviar_usuario'])) {
    $Codigo_usuario = $_POST['Codigo_usuario'];
    print_r($Codigo_usuario);
    $Nombre_usuario = $_POST['Nombre_usuario'];
    print_r($Nombre_usuario);
    $Clave_usuario = $_POST['Clave_usuario'];
    print_r($Clave_usuario);
    $Rol_usuario = $_POST['Rol_usuario'];
    print_r($Rol_usuario);
    // Primero buscar la clave, si ya existe, no insertar
    $existe = false;
    foreach ($usuarios as $user) {
        if ($Codigo_usuario == $user['Codigo']) {
            $existe = true;
        }
    }
    // Si no existe, insertar usuario
    if (!$existe) {
        $query_insertar_usuario = "INSERT INTO usuarios VALUES(:Codigo ,:Nombre ,:Clave ,:Rol)";
        $preparada_usuario = $pdo ->prepare($query_insertar_usuario);
        $preparada_usuario->execute(array(':Codigo'=>$Codigo_usuario,
                                    ':Nombre'=>$Nombre_usuario,
                                    ':Clave'=>$Clave_usuario,
                                    ':Rol'=>$Rol_usuario));
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Empresa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body class="m-3">
        <!-- Si se ha obtenido la lista de empleados, muestra la tabla -->
<?php if (isset($array_empleados) && count($array_empleados) > 0): ?>
        <table class="table" border="1" cellpadding="1">
                <thead>
                    <tr><th colspan="5">EMPLEADOS</th></tr>
                    <tr>
                        <th>Código Empleado</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th>Departamento</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($array_empleados as $value): ?>
                        <tr>
                            <td><?= $value['CodEmple'] ?></td>
                            <td><?= $value['Nombre'] ?></td>
                            <td><?= $value['Apellido1'] ?></td>
                            <td><?= $value['Apellido2'] ?></td>
                            <td><?= $value['Departamento'] ?></td>
                        </tr>
    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
<?php endif; ?>

        <!-- Formulario para consultar datos de usuario por código -->
        <h3 class="border-bottom border-dark">CONSULTA DE USUARIOS</h3>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="Codigo" class="form-label">Código de usuario :</label>
            <input type="text" name="Codigo" id="Codigo" class="form-control">
            <input type="submit" name="enviar_cod_usuario" value="Enviar" class="m-3 btn btn-primary">
        </form>
        <!-- Si se ha devuelto un usuario -->
<?php if (isset($usuario)): ?>
    <?php if ($usuario == null): ?>
        <p class="alert alert-warning">No hay ningún usuario con ese código</p>
    <?php else : ?>
                <br><!-- Mostrar empleado -->
                <table class="table">
                            <tbody>
                            <th colspan="2" class="alert alert-info">Usuario Encontrado</th>
                                <tr>
                                    <td>Código :</td>
                                    <td><?= $usuario['Codigo'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nombre :</td>
                                    <td><?= $usuario['Nombre'] ?></td>
                                </tr>
                                <tr>
                                    <td>Clave :</td>
                                    <td><?= $usuario['Clave'] ?></td>
                                </tr>
                                <tr>
                                    <td>Rol :</td>
                                    <td><?= $usuario['Rol'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                <br>
    <?php endif; ?>
<?php endif; ?>

        <!-- Formulario de login -->
        <h3 class="border-bottom border-dark">LOGIN</h3>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="Nombre" class="form-label">Nombre de usuario :</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control">
            <label for="Clave" class="form-label">Contraseña :</label>
            <input type="text" name="Clave" id="Clave" class="form-control">
            <input type="submit" name="enviar_login" value="Enviar" class="m-3 btn btn-primary">
        </form>
<?php if (isset($nombre_usuario) && isset($clave_usuario)) : ?>
            <br>
            <!-- Comprobar nombre y clave -->
    <?php if (!$flag_nombre) : ?>
                <p class="alert alert-warning">Usuario no Encontrado</p>
            <?php else : ?>
                <?php if (!$flag_clave) : ?>
                <p class="alert alert-warning">Clave Incorrecta</p>
                <?php else : ?>
                <p class="alert alert-info">Login Correcto</p>
                <?php endif; ?>
            <?php endif; ?>
            <br>
        <?php endif; ?>
        <!-- Formulario para insertar usuarios en la tabla usuarios -->
        <h3 class="border-bottom border-dark">INSERTAR USUARIOS</h3>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="Codigo_usuario" class="form-label">Código de usuario :</label>
            <input type="text" name="Codigo_usuario" id="Codigo_usuario" class="form-control">
            <label for="Nombre_usuario" class="form-label">Nombre de usuario :</label>
            <input type="text" name="Nombre_usuario" id="Nombre_usuario" class="form-control">
            <label for="Clave_usuario" class="form-label">Clave :</label>
            <input type="text" name="Clave_usuario" id="Clave_usuario" class="form-control">
            <label for="Rol_usuario" class="form-label">Rol :</label>
            <input type="text" name="Rol_usuario" id="Rol_usuario" class="form-control">
            <input type="submit" name="enviar_usuario" value="Enviar" class="m-3 btn btn-primary">
        </form>
<?php if (isset($Codigo_usuario) && $Codigo_usuario != '') : ?>
    <?php if ($existe): ?>
        <p class="alert alert-warning">El Código de este usuario ya existe</p>
    <?php else : ?>
        <?php if($preparada_usuario->rowCount()==1) :?>
                <p class="alert alert-info">Usuario insertado con éxito</p>    
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
    </body>
</html>
