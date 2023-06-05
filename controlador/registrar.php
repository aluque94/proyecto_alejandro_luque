<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../vista/pagcliente/css/estilos.css">
    <title>Registrar</title>
</head>
<body>

    <div class="login">
        <!-- El formulario para registrar un nuevo usuario. -->
        <form method="post" action="registrar.php">
            <div class="titulo">Registro de usuario</div>

            <div class="datos">Introducir nombre: </div>
            <input type="text" name="nombre">

            <div class="datos">Introducir apellidos: </div>
            <input type="text" name="apellidos">

            <div class="datos">Introducir nombre de usuario: </div>
            <input type="text" name="usuario">

            <div class="datos">Introducir contraseña: </div>
            <input type="password" name="contrasena">

            <div class="botones">
                <input type="submit" name="Aceptar" value="Aceptar">
                <input type="reset" name="Borrar" value="Borrar">
            </div>
        </form>

        <?php

            include "../modelo/consultas.php";
            
            /* Una vez dados los datos, se registran en la base de datos. */
            if (isset($_POST['Aceptar'])) {
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];

                registrarUsuario($nombre, $apellidos, $usuario, $contrasena);

                echo "<a href='login.php'>Volver a inicio de sesión</a>";
            }
        ?>

    </div>
</body>
</html>