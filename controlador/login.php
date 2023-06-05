<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../vista/pagcliente/css/estilos.css">
    <script src="jquery/jquery-3.6.0.min.js"></script>
    <script src="../vista/pagcliente/js/controlador.js"></script>
    <title>Login</title>
</head>
<body>

    <div class="login">
        <!-- El formulario que el usuario llenará para iniciar sesión. -->
        <form method="post" action="login.php">
            <div class="titulo">Iniciar sesión</div>

            <div class="datos">Usuario:</div>
            <input type="text" name="usuario">

            <div class="datos">Contraseña:</div>
            <input type="password" name="contrasena" id="txtcontrasena">

            <div class="datos">
                <input type="checkbox" id="mostrar" onclick="verpassword()">Mostrar Contraseña<br>
                <a href="registrar.php">Regístrate</a>
            </div>

            <div class="botones">
                <input type="submit" name="Entrar" value="Entrar">
                <input type="reset" name="Borrar" value="Borrar">
            </div>
        </form>

        <?php

            include "../modelo/consultas.php";

            /* Una vez el usuario clica en el botón Entrar, se comprueba si el usuario existe en la base de datos. 
            Si es admin, redirige a la ventana de adnmin.
            Si es usuario registrado, a la zona de usuario.
            Si no existe o está equivocado en uno de los campos, saltará un mensaje. */
            if (isset($_POST['Entrar'])) {
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];
                $comprobar = comprobarUsuario($usuario, $contrasena);
                
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $id;

                switch ($comprobar) {
                    case 'superadmin' :
                        header('Location: ../vista/pagadmin/admin.php');
                        break;
                    case "registrado":
                        header('Location: ../vista/pagcliente/citasUsuario.php');
                    default:
                        echo "Usuario o contraseña erróneos. Inténtelo de nuevo";
                        break;
                }

            }

        ?>

    </div>

</body>
</html>