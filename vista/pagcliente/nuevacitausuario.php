<?php
    error_reporting(0);
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedir cita</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet"/>
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: black" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">Peluquería LaClasse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item">
                        <form action="citasUsuario.php" method="post">
                            <button type="submit" name="logout_btn" class="nav-link" style="background-color: transparent;"><a href="../../index.html">CERRAR SESIÓN</a></button>
                        </form>
                        <?php 
                            // Para cerrar la sesión, pongo un botón para, una vez pulsado se destrya la sesión y se resetee
                            if (isset($_POST['logout_btn'])) {
                                session_destroy();
                                unset($_SESSION['usuario']);
                            }
                                
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-section">
        <div class="container-fluid">
            <h1>Citas</h1>

            <div class="container">
                <form method="post" action="nuevacitausuario.php">
                    <?php

                        include "../../modelo/consultas.php";

                        /* Se obtiene el nombre de usuario de la sesión. */
                        $usuario = $_SESSION['usuario'];

                        /* Nombre y apellido del usuario. */
                        $nombre = nombreUsuario($usuario);
                        $apellidos = apellidosUsuario($usuario);

                        echo "Lista de Citas de " . $usuario . "<br>";

                        /* Si vengo de haber pulsado en editar. */
                        if (isset($_GET['editar'])) {
                            $id = $_GET['editar'];

                            /* Con el ID obtenemos de nuevo todos los datos de la cita. */
                            $datoscita = mysqli_fetch_assoc(getCita($id));

                            echo "Modificar cita " . $datoscita['Nombre'] . " " . $datoscita['Apellidos'];
                        } else {
                            /* Si vengo de otro lado */
                            echo "<br>Nueva cita";
                            $datoscita = ["Nombre" => $nombre,
                                "Apellidos" => $apellidos,
                                "Fecha" => "",
                                "Hora" => "",
                                "Asiento" => ""];

                            echo "<div>Nombre: </div>
                            <input type='text' name='nombre' id='nombre' value='$nombre' disabled>
                                
                            <div>Apellidos: </div>
                            <input type='text' name='apellidos' id='apellidos' value='$apellidos' disabled>";
                        }
                    ?>

                    <div>Fecha: </div>
                    <input type="date" name="fecha" id="fecha" value=<?php echo $datoscita["Fecha"] ?>>

                    <div>Hora: </div>
                    <input type="time" name="hora" min="09" max="20" step="900" value=<?php echo $datoscita["Hora"] ?>>

                    <div>Asiento: </div>
                    <select name="asiento" value="asiento">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                    </select>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="botones">
                        <input type="hidden" name='id' value=<?php echo $id; ?>>
                        <input type="submit" class="btn btn-success" name="Pedir" value="Pedir">
                        <input type="reset" class="btn btn-danger" name="Borrar" value="Borrar">
                    </div>
                </form>

                <?php

                    if (isset($_POST['Pedir'])) {
                        $fecha = $_POST['fecha'];
                        $hora = $_POST['hora'];
                        $asiento = $_POST['asiento'];

                        /* Actualizo las funciones para establecer los valores por defecto. */
                        if (isset($_POST['id'])) {
                            $id = $_POST['id'];

                            /* Si ID vale algo, estoy modificando. */
                            if ($id > 0) {
                                modificarCita($id, $fecha, $hora, $asiento);
                                echo "Cita modificada";
                            } else {
                                /* Si ID no vale nada, estoy añadiendo. */
                                anadirCita($nombre, $apellidos, $fecha, $hora, $asiento);
                                echo "Cita registrada";
                            }
                        } 

                        echo "<br><a href='citasusuario.php'>Volver a la lista de citas</a>";
                    }

                ?>
            </div>
        </div>
    </section>
</body>
</html>